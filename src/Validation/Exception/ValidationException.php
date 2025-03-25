<?php

declare(strict_types=1);

namespace App\Validation\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Ошибка валидации, выбрасываемая при неверных входных данных.
 */
class ValidationException extends BadRequestHttpException
{
    private array $errors;

    /**
     * @param array $errors Ошибки валидации
     * @param int $statusCode Код статуса (по умолчанию 422)
     */
    public function __construct(array $errors = [], int $statusCode = 422)
    {
        // Если ошибок нет, передаем дефолтные ошибки
        if (empty($errors)) {
            $errors = [['message' => 'Некорректные данные']];
        }

        parent::__construct('Validation failed', null, $statusCode);
        $this->errors = $errors;
    }

    /**
     * Возвращает список ошибок
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
