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
        $menu = $request->request->get('menu_id', false);
        $user = $request->request->get('user_id',false);
        $paiement = $request->request->get('paiement',false);

        var_dump($menu);

        $commandes = $this->commandesService->add($menu, $user, $paiement);
        return $this->json($commandes);
    }

    // update commandes
    #[Route('/update/{id}', name:'update_commandes', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $menu = $request->request->get('menu_id',false);
        $user = $request->request->get('user_id',false);
        $status = $request->request->get('status',false);
        $paiement = $request->request->get('paiement',false);

        $commandes = $this->commandesService->update($id, $menu, $user, $status, $paiement);
        return $this->json($commandes);
    }


}