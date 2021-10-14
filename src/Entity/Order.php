<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $payment_hour;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $delivery_hour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Dishes::class, inversedBy="orders")
     */
    private $dish;

    public function __construct()
    {
        $this->dish = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPaymentHour(): ?\DateTimeInterface
    {
        return $this->payment_hour;
    }

    public function setPaymentHour(?\DateTimeInterface $payment_hour): self
    {
        $this->payment_hour = $payment_hour;

        return $this;
    }

    public function getDeliveryHour(): ?\DateTimeInterface
    {
        return $this->delivery_hour;
    }

    public function setDeliveryHour(?\DateTimeInterface $delivery_hour): self
    {
        $this->delivery_hour = $delivery_hour;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Dishes[]
     */
    public function getDish(): Collection
    {
        return $this->dish;
    }

    public function addDish(Dishes $dish): self
    {
        if (!$this->dish->contains($dish)) {
            $this->dish[] = $dish;
        }

        return $this;
    }

    public function removeDish(Dishes $dish): self
    {
        $this->dish->removeElement($dish);

        return $this;
    }

}
