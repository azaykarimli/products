<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource; // Import the ApiResource class
use Ramsey\Uuid\Doctrine\UuidGenerator;


use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource] // For exposing as an API resource

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The name field cannot be blank.")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "The name must be at least {{ limit }} characters long.",
        maxMessage: "The name cannot be longer than {{ limit }} characters."
    )]
    private ?string $name = null;

    #[ORM\Column(type: "float")]
    #[Assert\NotBlank(message: "The price field cannot be blank.")]
    #[Assert\Positive(message: "The price must be a positive value.")]
    private ?float $price = null;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "The quantity field cannot be blank.")]
    #[Assert\Positive(message: "The quantity must be a positive value.")]
    private ?int $qty = null;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private ?float $income = 0;

    // Getters and setters...

    public function getId(): ?string
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getIncome(): ?float
    {
        return $this->income;
    }

    public function setIncome(float $income): self
    {
        $this->income = $income;

        return $this;
    }
}
