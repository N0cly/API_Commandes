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
        return new JsonResponse($this->commandesService->getAll());
    }
    
    // affiche une commande
    #[Route('/{id}', name:'get_commande', methods: ['GET'])]
    public function getCommande(int $id): JsonResponse
    {
        return new JsonResponse($this->commandesService->getCommande($id));
    }

    // add commandes
    #[Route('/', name:'add_commandes', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $jsonString = $request->getContent();

        // Décoder la chaîne JSON en un tableau associatif PHP
        $data = json_decode($jsonString, true);

        return new JsonResponse($this->commandesService->add($data['menu_id'], $data['user_id'], $data['paiement']));
    }

    // update commandes
    #[Route('/{id}', name:'update_commandes', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $jsonString = $request->getContent();

        // Décoder la chaîne JSON en un tableau associatif PHP
        $data = json_decode($jsonString, true);

        $menu = $data['menu_id'] ?? null;
        $user = $data['user_id'] ?? null;
        $status = $data['status'] ?? null;
        $paiement = $data['paiement'] ?? null;

        return new JsonResponse($this->commandesService->update($id, $menu, $user, $status, $paiement));
    }

    // delete commandes
    #[Route('/{id}', name:'delete_commandes', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return new JsonResponse($this->commandesService->deleteCommande($id));
    }

    // get commandes by user
    #[Route('/user/{id}', name:'get_commandes_by_user', methods: ['GET'])]
    public function getCommandesByUser(int $id): JsonResponse
    {
        return new JsonResponse($this->commandesService->getCommandesByUser($id));
    }

    // get commandes by menu
    #[Route('/menu/{id}', name:'get_commandes_by_menu', methods: ['GET'])]
    public function getCommandesByMenu(int $id): JsonResponse
    {
        return new JsonResponse($this->commandesService->getCommandesByMenu($id));
    }

    //get commandes by status
    #[Route('/status/{status}', name:'get_commandes_by_status', methods: ['GET'])]
    public function getCommandesByStatus(string $status): JsonResponse
    {
        return new JsonResponse($this->commandesService->getCommandesByStatus($status));
    }

    // get commandes by date
    #[Route('/date', name:'get_commandes_by_date', methods: ['POST'])]
    public function getCommandesByDate(Request $request): JsonResponse

    {
        $jsonString = $request->getContent();

        // Décoder la chaîne JSON en un tableau associatif PHP
        $data = json_decode($jsonString, true);

        $date = $data['date'] ?? null;
        return new JsonResponse($this->commandesService->getCommandesByDate($date));
    }

    // get commandes by paiement
    #[Route('/paiement/{paiement}', name:'get_commandes_by_paiement', methods: ['GET'])]
    public function getCommandesByPaiement(string $paiement): JsonResponse
    {
        return new JsonResponse($this->commandesService->getCommandesByPaiement($paiement));
    }


}