<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $deliveryAddress;

    #[ORM\Column(type: 'string', length: 5)]
    private $deliveryZipcode;

    #[ORM\Column(type: 'string', length: 50)]
    private $deliveryCity;

    #[ORM\Column(type: 'string', length: 255)]
    private $billAddress;

    #[ORM\Column(type: 'string', length: 5)]
    private $billZipcode;

    #[ORM\Column(type: 'string', length: 50)]
    private $billCity;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $coeff;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $individualLastname;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $individualFirstname;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $professionnalContact;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $professionnalBrand;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $professionnalSiren;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Employee::class, inversedBy: 'customer')]
    private $employee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getBillZipcode(): ?string
    {
        return $this->billZipcode;
    }

    public function setBillZipcode(string $billZipcode): self
    {
        $this->billZipcode = $billZipcode;

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

    public function getCoeff(): ?string
    {
        return $this->coeff;
    }

    public function setCoeff(string $coeff): self
    {
        $this->coeff = $coeff;

        return $this;
    }

    public function getIndividualLastname(): ?string
    {
        return $this->individualLastname;
    }

    public function setIndividualLastname(?string $individualLastname): self
    {
        $this->individualLastname = $individualLastname;

        return $this;
    }

    public function getIndividualFirstname(): ?string
    {
        return $this->individualFirstname;
    }

    public function setIndividualFirstname(?string $individualFirstname): self
    {
        $this->individualFirstname = $individualFirstname;

        return $this;
    }

    public function getProfessionnalContact(): ?string
    {
        return $this->professionnalContact;
    }

    public function setProfessionnalContact(string $professionnalContact): self
    {
        $this->professionnalContact = $professionnalContact;

        return $this;
    }

    public function getProfessionnalBrand(): ?string
    {
        return $this->professionnalBrand;
    }

    public function setProfessionnalBrand(?string $professionnalBrand): self
    {
        $this->professionnalBrand = $professionnalBrand;

        return $this;
    }

    public function getProfessionnalSiren(): ?string
    {
        return $this->professionnalSiren;
    }

    public function setProfessionnalSiren(?string $professionnalSiren): self
    {
        $this->professionnalSiren = $professionnalSiren;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTimeImmutable();


        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
