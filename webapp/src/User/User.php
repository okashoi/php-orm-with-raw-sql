<?php

declare(strict_types=1);

namespace App\User;

use DateTimeInterface;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use JsonSerializable;
use LogicException;

/**
 * @property int $id
 * @property string $name
 * @property DateTimeImmutable $created_at
 * @method static list<User> hydrate(array $items)
 */
class User extends Model implements JsonSerializable
{
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $casts = [
        'created_at' => 'immutable_datetime',
    ];
    public $timestamps = false;

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
            'createdAt' => $this->created_at->format(DateTimeInterface::RFC3339),
        ];
    }
}
