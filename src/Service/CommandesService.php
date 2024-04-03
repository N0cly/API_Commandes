<?php

namespace App\Service;

use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;


class CommandesService
{
    private CommandesRepository $repository;
    private EntityManagerInterface $entityManager;

    public function __construct(CommandesRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        $commandes = $this->repository->findAll();
        $data = [];
        foreach ($commandes as $commande) {
            $data[] = [
                'commande_id' => $commande->getId(),
                'user' => $commande->getUserId(),
                'menu' => $commande->getMenuId(),
                'status' => $commande->getStatus(),
                'date' => $commande->getDate(),
                'paiement' => $commande->getPaiement(),
            ];
        }
        return $data;
    }

    public function add(int $menu, int $user, string $paiement): array
    {
        $commande = new Commandes();
        $commande->setMenuId($menu);
        $commande->setUserId($user);
        $commande->setStatus('En attente');
        $commande->setDate(date('d/m/Y'));
        $commande->setPaiement($paiement);
        $this->entityManager->persist($commande);
        $this->entityManager->flush();
        return [
            'commande_id' => $commande->getId(),
            'user' => $commande->getUserId(),
            'menu' => $commande->getMenuId(),
            'date' => $commande->getDate(),
            'paiement' => $commande->getPaiement(),
        ];
    }

    public function update(int $id, ?int $menu, ?int $user, ?string $status, ?string $paiement)
    {
        $commande = $this->repository->find($id);

        if ($menu) {
            $commande->setMenuId($menu);
        }
        if ($user) {
            $commande->setUserId($user);
        }
        if ($status) {
            $commande->setStatus($status);
        }
        if ($paiement) {
            $commande->setPaiement($paiement);
        }
        $this->entityManager->flush();
        return [
            'commande_id' => $commande->getId(),
            'user' => $commande->getUserId(),
            'menu' => $commande->getMenuId(),
            'status' => $commande->getStatus(),
            'date' => $commande->getDate(),
            'paiement' => $commande->getPaiement(),
        ];
    }


}