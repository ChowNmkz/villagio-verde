<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->shippingItems = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read:product")]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read:product")]
    private $name; 

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups("read:product")]
    private $buyPrice;

    #[ORM\Column(type: 'integer')]
    #[Groups("read:product")]
    private $stock;

    #[ORM\Column(type: 'text')]
    #[Groups("read:product")]
    private $description;

    #[ORM\Column(type: 'boolean')]
    private $publish;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups("read:product")]
    private $sellPrice;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Image::class)]
    #[Groups("read:product")]
    private $images;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("read:product")]
    private $category;

    #[ORM\ManyToOne(targetEntity: Supplier::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("read:product")]
    private $supplier;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ShippingItem::class)]
    private $shippingItems;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBuyPrice(): ?string
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(string $buyPrice): self
    {
        $this->buyPrice = $buyPrice;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(bool $publish): self
    {
        $this->publish = $publish;

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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getSellPrice(): ?string
    {
        return $this->sellPrice;
    }

    public function setSellPrice(string $sellPrice): self
    {
        $this->sellPrice = $sellPrice;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

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
            $shippingItem->setProduct($this);
        }

        return $this;
    }

    public function removeShippingItem(ShippingItem $shippingItem): self
    {
        if ($this->shippingItems->removeElement($shippingItem)) {
            // set the owning side to null (unless already changed)
            if ($shippingItem->getProduct() === $this) {
                $shippingItem->setProduct(null);
            }
        }

        return $this;
    }
}
