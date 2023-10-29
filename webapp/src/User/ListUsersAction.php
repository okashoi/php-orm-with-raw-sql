<?php

declare(strict_types=1);

namespace App\User;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ListUsersAction
{
    public function __construct(
        private EntityManager $db,
    ) {
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $rsm = new ResultSetMappingBuilder($this->db);
        $rsm->addRootEntityFromClassMetadata(User::class, 'users');

        $this->db->beginTransaction();

        $query = $this->db->createNativeQuery('SELECT * FROM users', $rsm);
        /** @var list<User> $users */
        $users = $query->getResult();

        $this->db->commit();

        $response->getBody()->write(json_encode($users, JSON_PRETTY_PRINT));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
