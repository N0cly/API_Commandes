<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class CommandesService
{

    public function getAll(): array
    {
        return [
            'message' => 'Liste de toutgfgges les commandes'
        ];
    }
}