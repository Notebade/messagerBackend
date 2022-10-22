<?php

namespace Dialog\Controller;

use Dialog\Aplication\Service\DialogSearcher;
use Slim\Http\Request;
use Slim\Http\Response;
use User\Presenter\User;

class DialogController
{
    private function getService(): DialogSearcher
    {
        return new DialogSearcher();
    }

    public function createDialog(Request $request, Response $response): Response
    {
        global $auth;
        $data['user'] = User::present($auth->user);
        return $response->withJson($this->getService()->createDialog($data));
    }

    public function connectDialog(Request $request, Response $response): Response
    {
        global $auth;
        $data['id'] = $request->getParam('id');
        $data['user'] = User::present($auth->user);
        return $response->withJson($this->getService()->connectDialog($data));
    }

    public function getDialogById(Request $request, Response $response): Response
    {
        $data = $request->getParams();
        $data['id'] = $request->getAttribute('id');
        return $response->withJson($this->getService()->getDialogById($data));
    }

    public function sendDialog(Request $request, Response $response): Response
    {
        global $auth;
        $data = $request->getParams();
        $data['user'] = User::present($auth->user);
        return $response->withJson($this->getService()->sendDialog($data));
    }

    public function getDialogs(Request $request, Response $response): Response
    {
        global $auth;
        return $response->withJson($this->getService()->listDialogs($auth->user));
    }

    public function leaveDialog(Request $request, Response $response): Response
    {
        global $auth;
        return $response->withJson($this->getService()->leaveDialog($auth->user));
    }

    public function updateUser(Request $request, Response $response): Response
    {
        $data = $request->getParams() ?? [];
        return $response->withJson($this->getService()->updateUser($data));
    }

    public function deleteUser(Request $request, Response $response): Response
    {
        $data = $request->getParams() ?? [];
        return $response->withJson($this->getService()->deleteUser($data));
    }
}