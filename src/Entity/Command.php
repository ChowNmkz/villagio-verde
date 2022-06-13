<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $orderDate;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $extraDiscount;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $paymentDate;

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    private $paymentType;

    #[ORM\Column(type: 'string', length: 255)]
    private $deliveryAddress;

    #[ORM\Column(type: 'string', length: 10)]
    private $deliveryZipcode;

    #[ORM\Column(type: 'string', length: 50)]
    private $deliveryCity;

    #[ORM\Column(type: 'string', length: 255)]
    private $billAddress;

    #[ORM\Column(type: 'string', length: 10)]
    private $billZpicode;

    #[ORM\Column(type: 'string', length: 50)]
    private $billCity;

    #[ORM\Column(type: 'string', length: 50)]
    private $status = self::STATUS_CART;

    const STATUS_CART = 'cart';

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $customerCoeff;

    #[ORM\Column(type: 'string', length: 255)]
    private $billNumber;

    #[ORM\OneToMany(mappedBy: 'command', targetEntity: detail::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    private $detail;

    public function __construct()
    {
        $this->detail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getExtraDiscount(): ?string
    {
        return $this->extraDiscount;
    }

    public function setExtraDiscount(string $extraDiscount): self
    {
        $this->extraDiscount = $extraDiscount;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(?string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getDeliveryZipcode(): ?string
    {
        return $this->deliveryZipcode;
    }

    public function setDeliveryZipcode(string $deliveryZipcode): self
    {
        $this->deliveryZipcode = $deliveryZipcode;

        return $this;
    }

    public function getDeliveryCity(): ?string
    {
        return $this->deliveryCity;
    }

    public function setDeliveryCity(string $deliveryCity): self
    {
        $this->deliveryCity = $deliveryCity;

        return $this;
    }

    public function getBillAddress(): ?string
    {
        return $this->billAddress;
    }

    public function setBillAddress(string $billAddress): self
    {
        $this->billAddress = $billAddress;

        return $this;
    }

    public function getBillZpicode(): ?string
    {
        return $this->billZpicode;
    }

    public function setBillZpicode(string $billZpicode): self
    {
        $this->billZpicode = $billZpicode;

        return $this;
    }

    public function getBillCity(): ?string
    {
        return $this->billCity;
    }

    public function setBillCity(string $billCity): self
    {
        $this->billCity = $billCity;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCustomerCoeff(): ?string
    {
        return $this->customerCoeff;
    }

    public function setCustomerCoeff(string $customerCoeff): self
    {
        $this->customerCoeff = $customerCoeff;

        return $this;
    }

    public function getBillNumber(): ?string
    {
        return $this->billNumber;
    }

    public function setBillNumber(string $billNumber): self
    {
        $this->billNumber = $billNumber;

        return $this;
    }

    /**
     * @return Collection<int, detail>
     */
    public function getDetail(): Collection
    {
        return $this->detail;
    }

    public function addDetail(detail $detail): self
    {
        if (!$this->detail->contains($detail)) {
            $this->detail[] = $detail;
            $detail->setCommand($this);
        }

        return $this;
    }

    public function removeDetail(detail $detail): self
    {
        if ($this->detail->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCommand() === $this) {
                $detail->setCommand(null);
            }
        }

        return $this;
    }

    public function addDetails(Detail $detailItem): self
    {
        foreach ($this->getDetail() as $existingItem) {
            // The item already exists, update the quantity
            if ($existingItem->equals($detailItem)) {
                $existingItem->setQuantity(
                    $existingItem->getQuantity() + $detailItem->getQuantity()
                );
                return $this;
            }
        }

        $this->details[] = $detailItem;
        $detailItem->setCommand($this);

        return $this;
    }

    /**
     * Removes all items from the order.
     *
     * @return $this
     */
    public function removeDetails(): self
    {
        foreach ($this->getDetail() as $details) {
            $this->removeDetail($details);
        }

        return $this;
    }

    /**
     * Calculates the order total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getDetail() as $detail) {
            $total += $detail->getTotal();
        }

        return $total;
    }
}
