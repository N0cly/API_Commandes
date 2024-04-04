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

    // get a commande by id
    public function getCommande(int $id): array
    {
        $commande = $this->repository->find($id);
        if (!$commande) {
            return [
                'status' => 'Commande not found',
            ];
        } else {
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

    public function add(int $menu, int $user, string $paiement): array
    {
        $commande = new Commandes();
        $commande->setMenuId($menu);
        $commande->setUserId($user);
        $commande->setStatus(1);
        $commande->setDate(date('d/m/Y'));
        $commande->setPaiement($paiement);
        $this->entityManager->persist($commande);
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

    public function update(int $id, ?int $menu, ?int $user, ?string $status, ?string $paiement): array
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

    public function deleteCommande(int $id): array
    {
        $commande = $this->repository->find($id);
        if (!$commande) {
            return [
                'status' => 'Commande not found',
            ];
        } else {
            $this->entityManager->remove($commande);
            $this->entityManager->flush();
            return [
                'status' => 'Commande deleted',
            ];
        }
    }

    public function getCommandesByUser(int $id): array
    {
        $commandes = $this->repository->findBy(['user_id' => $id]);
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

    public function getCommandesByMenu(int $id): array
    {
        $commandes = $this->repository->findBy(['menu_id' => $id]);
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

    public function getCommandesByStatus(string $status): array
    {
        $commandes = $this->repository->findBy(['status' => $status]);
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

    public function getCommandesByDate(string $date): array
    {
        $commandes = $this->repository->findBy(['date' => $date]);
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

    public function getCommandesByPaiement(string $paiement): array
    {
        $commandes = $this->repository->findBy(['paiement' => $paiement]);
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


}