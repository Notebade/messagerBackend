<?php

namespace User;

use Slim\App;
use User\Controller\UserController;

class UserRoute
{

    public function __construct(App $app)
    {
        $controller = new UserController();
        $app->group('', function () use ($app, $controller) {
            $app->post('/{id: [0-9]+}', [$controller, 'getUserById']);
            $app->post('/update', [$controller, 'updateUser']);
            $app->post('/delete', [$controller, 'deleteUser']);
        });
    }
}