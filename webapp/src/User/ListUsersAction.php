<?php

declare(strict_types=1);

namespace App\User;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListUsersAction
{
    public function __construct(
        private PDO $db,
    ) {
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $this->db->beginTransaction();

        $stmt = $this->db->query('SELECT * FROM users;');
        /** @var list<User> $users */
        $users = [];
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $users[] = User::fromRow($row);
        }

        $this->db->commit();

        $response->getBody()->write(json_encode($users, JSON_PRETTY_PRINT));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
