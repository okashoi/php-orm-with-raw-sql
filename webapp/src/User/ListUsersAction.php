<?php

declare(strict_types=1);

namespace App\User;

use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListUsersAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $rows = DB::transaction(function () {
            return DB::select('SELECT * FROM users');
        });

        $users = User::hydrate($rows);

        $response->getBody()->write(json_encode($users, JSON_PRETTY_PRINT));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
