<?php

namespace Dialog;

use Slim\App;
use Dialog\Controller\DialogController;

class DialogRoute
{

    public function __construct(App $app)
    {
        $controller = new DialogController();
        $app->group('', function () use ($app, $controller) {
            $app->post('/', [$controller, 'createDialog']);
            $app->post('/connect', [new DialogController(), 'connectDialog']);
            $app->post('/{id: [0-9]+}', [$controller, 'getDialogById']);
            $app->post('/send', [$controller, 'sendDialog']);
            $app->post('/list', [new DialogController(), 'getDialogs']);
            $app->post('/leave', [new DialogController(), 'leaveDialog']);
            $app->post('/update', [$controller, 'updateDialog']);
            $app->post('/delete', [$controller, 'deleteDialog']);
        });
    }
}