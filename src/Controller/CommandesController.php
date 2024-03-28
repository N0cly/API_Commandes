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

    // add commande
    #[Route('/add', name:'add_commande', methods: ['GET'])]
    public function add(Request $resquest): JsonResponse
    {
        $user_id = $resquest->request->get('user_id', null);
        $plats_id = $resquest->request->get('plats_id', null);
        $date = date('d/m/Y');
        $paiement = $resquest->request->get('paiement', null);
        $prix = $resquest->request->get('prix', null);
        return new JsonResponse($this->commandesService->add($user_id, $plats_id, $date, $paiement, $prix));
    }


}