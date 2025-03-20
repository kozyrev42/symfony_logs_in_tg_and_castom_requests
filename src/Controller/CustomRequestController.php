<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomRequestController extends AbstractController
{
    #[Route('/api/custom-request', name: 'custom_request', methods: ['POST'])]
    public function handleRequest(Request $request, LoggerInterface $logger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        // Получаем параметры (например, name, email, age)
        $name = $data['name'] ?? 'Unknown';
        $email = $data['email'] ?? 'Unknown';
        $age = $data['age'] ?? 'Unknown';

        // Записываем в лог
        $logger->info('Получен запрос', [
            'name' => $name,
            'email' => $email,
            'age' => $age
        ]);

        return $this->json(['message' => 'Данные записаны в лог']);
    }
}
