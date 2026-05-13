<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Container\ContainerInterface;

use App\Application\Actions\User\ConnectUserAction;
use App\Application\Actions\User\UserMetricRetrievalAction;

return function (App $app) {
    $app->group('/api', function ($app)
    {
        $app->options('/{routes:.*}', function (Request $request, Response $response) {
            return $response;
        });

        $app->get('/version', function (Request $request, Response $response) {
            $data = [
                'app' => [
                    'version' => $_ENV['APP_VERSION'],
                    'php' => $_ENV['PHP_VERSION']
                ]
            ];
            $message = 'Connexion réussie.';
            $response->getBody()->write(json_encode(['message' => $message, 'data' => $data]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        });

        $app->post('/connect', ConnectUserAction::class);
        $app->post('/metric', UserMetricRetrievalAction::class);
    });

    $app->group('', function ($app)
    {
        $app->get('/view', function (Request $request, Response $response) {
            $html = file_get_contents(__DIR__ . '/../public/view/index.html');
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html');
        });

        $app->get('/{routes:.*}', function (Request $request, Response $response) {
            $html = file_get_contents(__DIR__ . '/../public/index.html');
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html');
        }); 
    });
};