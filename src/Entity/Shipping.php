<?php

namespace App\Entity;

use App\Repository\ShippingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShippingRepository::class)]
class Shipping
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $shippingDate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $deliveryDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $trackingNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $details;

    #[ORM\ManyToOne(targetEntity: command::class, inversedBy: 'shippings')]
    private $command;

    #[ORM\OneToMany(mappedBy: 'shipping', targetEntity: ShippingItem::class)]
    private $shippingItems;

    public function __construct()
    {
        $this->shippingItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shippingDate;
    }

    public function setShippingDate(\DateTimeInterface $shippingDate): self
    {
        $this->shippingDate = $shippingDate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getCommand(): ?command
    {
        return $this->command;
    }

    public function setCommand(?command $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Collection<int, ShippingItem>
     */
    public function getShippingItems(): Collection
    {
        return $this->shippingItems;
    }

    public function addShippingItem(ShippingItem $shippingItem): self
    {
        if (!$this->shippingItems->contains($shippingItem)) {
            $this->shippingItems[] = $shippingItem;
            $shippingItem->setShipping($this);
        }

        return $this;
    }

    public function removeShippingItem(ShippingItem $shippingItem): self
    {
        if ($this->shippingItems->removeElement($shippingItem)) {
            // set the owning side to null (unless already changed)
            if ($shippingItem->getShipping() === $this) {
                $shippingItem->setShipping(null);
            }
        }

        return $this;
    }
}
