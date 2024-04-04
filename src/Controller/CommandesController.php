<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CommandesService;


#[Route('/api/v1/commandes', name:'commandes')]
class CommandesController extends AbstractController
{

    private CommandesService $commandesService;

    public function __construct(CommandesService $commandesService)
    {
        $this->commandesService = $commandesService;
    }

    // affiche toutes les commandes
    #[Route('/', name:'get_all_commandes', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $commandes = $this->commandesService->getAll();
        return $this->json($commandes);
    }

    // add commandes
    #[Route('/add', name:'add_commandes', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $jsonString = $request->getContent();

        // Décoder la chaîne JSON en un tableau associatif PHP
        $data = json_decode($jsonString, true);

        $commandes = $this->commandesService->add($data['menu_id'], $data['user_id'], $data['paiement']);
        return $this->json($commandes);
    }

    // update commandes
    #[Route('/update/{id}', name:'update_commandes', methods: ['POST'])]
    public function update(Request $request, int $id): JsonResponse
    {

        $jsonString = $request->getContent();

        // Décoder la chaîne JSON en un tableau associatif PHP
        $data = json_decode($jsonString, true);

        $menu = $data['menu_id'];
        $user = $data['user_id'];
        $status = $data['status'];
        $paiement = $data['paiement'];

        var_dump($data);

        $commandes = $this->commandesService->update($id, $menu, $user, $status, $paiement);
        return $this->json($commandes);
    }


}