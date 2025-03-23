<?php

namespace App\Controller;

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{
    #[Route('/api/check-auth', name: 'check_auth', methods: ['GET'])]
    public function checkAuth(): JsonResponse
    {
        return new JsonResponse(['message' => 'Authenticated'], 200);
    }
}
