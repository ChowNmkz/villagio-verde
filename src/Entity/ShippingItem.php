<?php

namespace App\Entity;

use App\Repository\ShippingItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShippingItemRepository::class)]
class ShippingItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: shipping::class, inversedBy: 'shippingItems')]
    private $shipping;

    #[ORM\ManyToOne(targetEntity: product::class, inversedBy: 'shippingItems')]
    private $product;

    #[ORM\Column(type: 'integer')]
    private $quantity = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShipping(): ?shipping
    {
        return $this->shipping;
    }

    public function setShipping(?shipping $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

}
