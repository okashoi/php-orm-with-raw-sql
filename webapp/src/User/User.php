<?php

declare(strict_types=1);

namespace App\User;

use DateTimeInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\{ Column, Entity, GeneratedValue, Id };
use JsonSerializable;
use LogicException;

#[Entity]
class User implements JsonSerializable
{
    public function __construct(
        #[Column(name: 'name', type: 'string')]
        public string $name,
        #[Id, Column(name: 'id', type: 'integer', generated: 'INSERT'), GeneratedValue]
        public ?int $id = null,
        #[Column(name: 'created_at', type: 'datetime_immutable')]
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
