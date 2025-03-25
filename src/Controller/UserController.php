<?php

declare(strict_types=1);

namespace App\Controller;

use App\Validation\Request\User\UserRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'user_request', methods: ['POST'])]
    public function handleRequest(UserRequest $request, LoggerInterface $logger): JsonResponse
    {
        // Получаем валидированные данные
        $data = $request->getValidatedData();

        $logger->info('Получен запрос пользователя', [
            'name' => $data->name,
            'email' => $data->email,
            'age' => $data->age
        ]);

        return $this->json(['message' => 'Данные пользователя записаны в лог']);
    }
}
