<?php

namespace App\Manager;

use App\Entity\Command;
use App\Factory\CommandFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CartManager
 * @package App\Manager
 */
class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;

    /**
     * @var CommandFactory
     */
    private $commandFactory;

    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param CommandFactory $commandFactory
     */
    public function __construct(CartSessionStorage $cartStorage, CommandFactory $commandFactory, EntityManagerInterface $entityManager)
    {
        $this->cartSessionStorage = $cartStorage;
        $this->commandFactory = $commandFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Gets the current cart.
     *
     * @return Command
     */
    public function getCurrentCart(): Command
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->commandFactory->create();
        }

        return $cart;
    }

    /**
     * Persists the cart in database and session.
     *
     * @param Command $cart
     */
    public function save(Command $cart): void
    {
        // Persist in database
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        // Persist in session
        $this->cartSessionStorage->setCart($cart);
    }
}