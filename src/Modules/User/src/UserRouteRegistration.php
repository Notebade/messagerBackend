<?php

namespace User;

use Slim\App;
use User\Controller\UserController;

class UserRouteRegistration
{

    public function __construct(App $app)
    {
        $controller = new UserController();
        $app->post('', [$controller, 'createUser']);
    }
}