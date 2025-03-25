<?php

declare(strict_types=1);

namespace App\Validation\RequestResolver;

use App\Validation\Base\BaseValidatedRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Этот класс автоматически создает экземпляры классов, наследующих BaseValidatedRequest, и передаёт их в контроллер.
 */
class ValidatedRequestResolver implements ArgumentValueResolverInterface
{
    public function __construct(private ValidatorInterface $validator) {}

    // Метод supports() проверяет, является ли аргумент (UserRequest) наследником BaseValidatedRequest
    // Если да, то → Symfony вызовет resolve(), создаст объект UserRequest и передаст его в контроллер
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_subclass_of($argument->getType(), BaseValidatedRequest::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $validatedRequest = new ($argument->getType())($this->validator, $request);
        yield $validatedRequest;
    }
}
