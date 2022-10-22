<?php

namespace User\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use User\Aplication\Service\UserSearcher;
use User\Presenter\User;

class UserController
{
    private function getService(): UserSearcher
    {
        return new UserSearcher();
    }

    public function getUserById(Request $request, Response $response): Response
    {
        return $response->withJson($this->getService()->getUserById($request->getAttribute('id')));
    }

    public function updateUser(Request $request, Response $response): Response
    {
        global $auth;
        $auth->user->setInfo($request->getParam('info'));
        return $response->withJson($this->getService()->updateUser($auth->user));
    }

    public function deleteUser(Request $request, Response $response): Response
    {
        global $auth;
        return $response->withJson($this->getService()->deleteUser($auth->user));
    }

    public function createUser(Request $request, Response $response): Response
    {
        $data = $request->getParams() ?? [];
        return $response->withJson($this->getService()->createUser($data));
    }

}