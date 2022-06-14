<?php

namespace App\Factory;

use App\Entity\Command;
use App\Entity\Detail;
use App\Entity\Product;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class CommandFactory
{
   /* /**
     * Creates an order.
     *
     * @return Command
     */
    public function create(): Command
    {
        $order = new Command();
        $order->setOrderDate(new \DateTime());
        $order->setExtraDiscount(0);
        $order->setStatus(Command::STATUS_CART);
        return $order;
    }

    /**
     * Creates an item for a product.
     *
     * @param Product $product
     *
     * @return CommandItem
     */
    public function createDetail(Product $product): Detail
    {
        $item = new Detail();
        $item->setProduct($product);
        $item->setDiscount(0);
        $item->setQuantity(1);

        return $item;
    }
}