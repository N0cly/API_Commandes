<?php

namespace App\Controller;
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


}