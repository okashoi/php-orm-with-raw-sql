<?php

declare(strict_types=1);

namespace App\User;

use DateTimeInterface;
use DateTimeImmutable;
use JsonSerializable;
use LogicException;

class User implements JsonSerializable
{
    public function __construct(
        public string $name,
        public ?int $id = null,
        public DateTimeImmutable $createdAt = new DateTimeImmutable(),
    ) {
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
