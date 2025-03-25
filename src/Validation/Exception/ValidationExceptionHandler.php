<?php

declare(strict_types=1);

namespace App\Validation\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Обрабатывает исключение валидации и возвращает JSON-ответ.
 */
class ValidationExceptionHandler
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationException) {
            $response = new JsonResponse([
                'message' => 'Ошибка валидации',
                'errors' => $exception->getErrors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

            $event->setResponse($response);
        }
    }
}
