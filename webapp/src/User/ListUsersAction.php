<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListUsersAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        // TODO: DB の users テーブルから取得する
        $users = [
            new User(id: 1, name: 'Alice', createdAt: new \DatetImeImmutable('2023-10-01 9:00:00')),
            new User(id: 2, name: 'Bob', createdAt: new \DatetImeImmutable('2023-10-15 12:00:00')),
            new User(id: 3, name: 'Carol', createdAt: new \DatetImeImmutable('2023-10-31 15:00:00')),
        ];

        $response->getBody()->write(json_encode($users, JSON_PRETTY_PRINT));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
