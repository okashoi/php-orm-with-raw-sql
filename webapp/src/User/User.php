<?php

declare(strict_types=1);

namespace App\User;

use DateTimeInterface;
use DateTimeImmutable;
use Exception;
use JsonSerializable;
use LogicException;
use TypeError;
use UnexpectedValueException;

class User implements JsonSerializable
{
    public function __construct(
        public string $name,
        public ?int $id = null,
        public DateTimeImmutable $createdAt = new DateTimeImmutable(),
    ) {
    }

    public static function fromRow(array $row): User
    {
        if (!isset($row['id'], $row['name'], $row['created_at'])) {
            throw new UnexpectedValueException();
        }

        try {
            $createdAt = new DateTimeImmutable($row['created_at']);
        } catch (Exception) {
            throw new UnexpectedValueException();
        }

        try {
            return new User(
                id: $row['id'],
                name: $row['name'],
                createdAt: $createdAt,
            );
        } catch (TypeError) {
            throw new UnexpectedValueException();
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        if (is_null($this->id)) {
            throw new LogicException();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'createdAt' => $this->createdAt->format(DateTimeInterface::RFC3339),
        ];
    }
}
