<?php

namespace App\Entity;

use App\Repository\ClientCreditCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientCreditCardRepository::class)
 */
class ClientCreditCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Number;

    /**
     * @ORM\Column(type="integer")
     */
    private $client_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ShopClient",inversedBy="Client_Credit_Card")
     * @ORM\JoinColumn(name="client_id",referencedColumnName="id")
     */
    protected $Client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->Number;
    }

    public function setNumber(int $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    public function setClientId(int $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * @param mixed $Client
     */
    public function setClient($Client): void
    {
        $this->Client = $Client;
    }
}
