<?php

declare(strict_types=1);

namespace App\Validation\Request\User;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validation\Base\BaseValidatedRequest;
use App\Validation\Request\User\DTO\UserRequestData;

/**
 * Валидирует данные пользователя и формирует объект `UserRequestData`
 */
class UserRequest extends BaseValidatedRequest
{
    protected UserRequestData $validatedData;

    /**
     * Определяет правила валидации.
     */
    protected function getConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Length(['min' => 6, 'max' => 50])
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
            ],
            'age' => [
                new Assert\NotBlank(),
                new Assert\Type('integer'),
                new Assert\Range(['min' => 18, 'max' => 99])
            ]
        ]);
    }

    /**
     * Наполняет объект DTO валидированными данными.
     */
    protected function setValidatedData(): void
    {
        $data = $this->data;
        
        $this->validatedData = new UserRequestData(
            name: $data['name'],
            email: $data['email'],
            age: (int) $data['age']
        );
    }

    /**
     * Возвращает валидированные данные.
     */
    public function getValidatedData(): UserRequestData
    {
        return $this->validatedData;
    }
}
