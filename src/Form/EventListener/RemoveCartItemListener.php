<?php

namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Command;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class RemoveCartItemListener
 * @package App\Form\EventListener
 */
class RemoveCartItemListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    /**
     * Removes items from the cart based on the data sent from the user.
     *
     * @param FormEvent $event
     */
    public function postSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $cart = $form->getData();

        if (!$cart instanceof Command) {
            return;
        }

        // Removes items from the cart
        foreach ($form->get('items')->all() as $child) {
            if ($child->get('remove')->isClicked()) {
                $cart->removeDetail($child->getData());
                break;
            }
        }
    }
    };