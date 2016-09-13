<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


defined('ENABLE_REFACTORING')
    || define('ENABLE_REFACTORING', (boolean) getenv('ENABLE_REFACTORING'));

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

$container = new Slim\Container();
$container['displayErrorDetails'] = true;

$app = new \Slim\App($container);

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $user = new Scsmartflo\User($name);
    $greeting = $user->sayHello();

    $response->getBody()->write($greeting);

    return $response;
});

ENABLE_REFACTORING and $app->get('/api/v1', function (Request $request, Response $response) {
    $data = [
        'path' => '/api/v1',
        'available' => [
            'get-category',
            'get-product',
            'get-download',
            'send',
        ],
    ];
    $body = $response->getBody();
    $body->write(json_encode($data));

    return $response->withHeader('Content-type', 'application/json');
});

$app->any('/{all:.*}', function (Request $request, Response $response) {
    ob_start();

    // Run Zend Framework application
    $application = new Zend_Application(
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );
    $application->bootstrap()->run();

    $content = ob_get_clean();
    $body = $response->getBody();
    $body->write($content);

    return $response;
});

return $app;
