<?php
// NEED CRON : https://symfony.com/doc/5.4/the-fast-track/fr/24-cron.html
namespace App\Command;

use App\Repository\CommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class RemoveExpiredCartsCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var $commandRepository
     */
    private $commandRepository;

    protected static $defaultName = 'app:remove-expired-carts';

    /**
     * RemoveExpiredCartsCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param CommandRepository $commandRepository
     */
    public function __construct(EntityManagerInterface $entityManager, CommandRepository $commandRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->commandRepository = $commandRepository;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Removes carts that have been inactive for a defined period')
            ->addArgument(
                'days',
                InputArgument::OPTIONAL,
                'The number of days a cart can remain inactive',
                1
            )
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $days = $input->getArgument('days');

        if ($days <= 0) {
            $io->error('The number of days should be greater than 0.');
            return Command::FAILURE;
        }

        // Subtracts the number of days from the current date.
        $limitDate = new \DateTime("- $days days");
        $expiredCartsCount = 0;

        while($carts = $this->commandRepository->findCartsNotModifiedSince($limitDate)) {
            foreach ($carts as $cart) {
                // Items will be deleted on cascade
                $this->entityManager->remove($cart);
            }

            $this->entityManager->flush(); // Executes all deletions
            $this->entityManager->clear(); // Detaches all object from Doctrine

            $expiredCartsCount += count($carts);
        };

        if ($expiredCartsCount) {
            $io->success("$expiredCartsCount cart(s) have been deleted.");
        } else {
            $io->info('No expired carts.');
        }

        return Command::SUCCESS;
    }
}