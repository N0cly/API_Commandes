<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $menu_id = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255)]
    private ?int $paiement = null;

    #[ORM\Column(length: 255)]
    private ?int $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMenuId(): ?int
    {
        return $this->menu_id;
    }

    public function setMenuId(int $menu_id): static
    {
        $this->menu_id = $menu_id;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPaiement(): ?string
    {
        // return paiement with number
        return match ($this->paiement) {
            1 => 'Carte bancaire',
            2 => 'Paypal',
            3 => 'Espèce',
            4 => 'Apple Pay',
            5 => 'Google Pay',
            default => 'Paiement not found',
        };
    }

    public function setPaiement(int $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getStatus(): ?string
    {
        // return status with number
        return match ($this->status) {
            1 => 'En attente',
            2 => 'En cours',
            3 => 'Terminé',
            4 => 'Annulé',
            default => 'Status not found',
        };
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
