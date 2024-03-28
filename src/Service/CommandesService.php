<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
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
                'plats' => $commande->getPlatsId(),
                'date' => $commande->getDate(),
                'paiement' => $commande->getPaiement(),
                'prix' => $commande->getPrix()
            ];
        }
        return $data;
    }

    public function add($user_id, $plats_id, $date, $paiement, $prix): array
    {
        $commande = new Commandes();
        $commande->setUserId(1);
        $commande->setPlatsId([
            1,
            2,
            3
        ]);
        $commande->setDate(date('d/m/Y'));
        $commande->setPaiement('CB');
        $commande->setPrix(25.50);
        $this->entityManager->persist($commande);
        $this->entityManager->flush();
        return [
            'commande_id' => $commande->getId(),
            'user' => $commande->getUserId(),
            'plats' => $commande->getPlatsId(),
            'date' => $commande->getDate(),
            'paiement' => $commande->getPaiement(),
            'prix' => $commande->getPrix()
        ];

        /*$commande = new Commandes();
        $commande->setUserId($user_id);
        $commande->setPlatsId($plats_id);
        $commande->setDate($date);
        $commande->setPaiement($paiement);
        $commande->setPrix($prix);
        $this->entityManager->persist($commande);
        $this->entityManager->flush();
        return [
            'commande_id' => $commande->getId(),
            'user' => $commande->getUserId(),
            'plats' => $commande->getPlatsId(),
            'date' => $commande->getDate(),
            'paiement' => $commande->getPaiement(),
            'prix' => $commande->getPrix()
        ];*/


    }

}