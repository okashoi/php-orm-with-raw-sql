<?php

declare(strict_types=1);

use App\User\ListUsersAction;
use Slim\App;

return function (App $app) {
    $app->get('/users', ListUsersAction::class);
};
