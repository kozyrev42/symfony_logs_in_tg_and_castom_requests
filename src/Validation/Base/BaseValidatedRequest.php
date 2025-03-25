<?php

declare(strict_types=1);

namespace App\Validation\Base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validation\Exception\ValidationException;

abstract class BaseValidatedRequest
{
    protected array $data = [];
    protected ?ConstraintViolationListInterface $validationErrors = null;

    public function __construct(protected ValidatorInterface $validator, protected Request $request)
    {
        $this->data = $this->request->toArray(); // Получаем JSON-данные из запроса

        // Выполняем валидацию
        $this->validationErrors = $this->validate();

        // Если есть ошибки — выбрасываем ValidationException
        if (count($this->validationErrors) > 0) {
            throw new ValidationException($this->getErrors());
        }

        // Если ошибок нет — сохраняем валидированные данные
        if (count($this->validationErrors) === 0) {
            $this->setValidatedData();
        }
    }

    abstract protected function getConstraints(): Assert\Collection;

    abstract protected function setValidatedData(): void;

    protected function validate(): ?ConstraintViolationListInterface
    {
        return $this->validator->validate($this->data, $this->getConstraints());
    }

    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->validationErrors as $error) {
            $errors[] = [
                'property' => preg_replace('/[\[\]]/u', '', $error->getPropertyPath()),
                'value' => $error->getInvalidValue(),
                'message' => $error->getMessage(),
            ];
        }

        return $errors;
    }

    /**
     * Возвращает любой тип (объект или массив)
     */
    public function getValidatedData(): mixed
    {
        return $this->data;
    }
}
