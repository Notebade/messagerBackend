<?php

/**
 * пространства имен
 */

use Dialog\DialogRoute;
use Dotenv\Dotenv;
use Slim\App;
use User\UserRoute;
use User\UserRouteRegistration;

/**
 * require_once connection
 * подключение стандартов PSR-4 and PSR-0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/vendor/autoload.php';


/**
 * @var $dotEnv
 * чтение ENV фала переменные окружения
 */
/*$dotEnv = Dotenv::create($_SERVER['DOCUMENT_ROOT']);
$dotEnv->load();*/

/**
 * include_once connection
 * @var $container
 * ConfigController файл конфигураций
 * @var $app
 */
$container = include_once $_SERVER['DOCUMENT_ROOT'] . '/src/configs/ConfigController.php';
$app = new App($container);
unset($app->getContainer()['errorHandler']);
unset($app->getContainer()['phpErrorHandler']);

/**
 * ловля route
 */

$app->get('', function () use ($app) {
   echo 'download apk file';
});
switch ((bool)$auth->user->getId()) {
    case true:
        $app->group('/user', function () use ($app) {
            return new UserRoute($this);
        });
        $app->group('/dialog', function () use ($app) {
            return new DialogRoute($this);
        });
        $app->group('/info', function () use ($app) {
            return new UserRoute($this);
        });
        break;
    case false:
        $app->group('/user/start', function () use ($app) {
            return new UserRouteRegistration($this);
        });
        break;
}

$app->run();
