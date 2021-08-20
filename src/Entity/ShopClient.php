<?php

namespace App\Entity;

use App\Repository\ShopClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopClientRepository::class)
 */
class ShopClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LastName;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClientCreditCard",mappedBy="Client")
     */
    protected $Client_Credit_Card;


    public function __toString(){
        return $this->Name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }
}
