<?php

declare(strict_types=1);

namespace App\Validation\Request\User\DTO;

/**
 * DTO-класс для хранения валидированных данных пользователя.
 * 
 *  1. Чёткого разделения данных – DTO хранит только валидированные данные, без лишних полей и логики.
 *
 *  2. Типизации – IDE и PHPStan сразу понимают, какие данные есть в объекте (а не просто массив).
 * 
 *  3. Повышения удобства работы – в коде работаем с $userDto->name, $userDto->email, а не с $data['name'] ?? ''. 
 * 
 *  4. Безопасности – DTO защищает от случайного изменения структуры данных.
 * 
 *  5. Гибкости – можно легко переиспользовать DTO в других частях приложения.
 * 
 */
class UserRequestData
{
    public function __construct(
        public string $name,
        public string $email,
        public int $age
    ) {}
}
