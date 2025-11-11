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
    $app->group('', function ($app)
    {
        $app->options('/{routes:.*}', function (Request $request, Response $response) {
            return $response;
        });

        $app->get('/', function (Request $request, Response $response) {
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

        $app->get('/app', function (Request $request, Response $response) {
            $html = file_get_contents(__DIR__ . '/../public/index.html');
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html');
        }); 
        
        $app->get('/view', function (Request $request, Response $response) {
            $html = file_get_contents(__DIR__ . '/../public/view/index.html');
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html');
        }); 

        // $app->post('/dev', function (Request $request, Response $response) {
        //     $data = [
        //         $request->getParsedBody(),
        //         'result_1' => hash_equals(hash_hmac($_ENV['HASH_ALGO'], 'martin' , $_ENV['HASH_SECRET'], false), '4ddcf1015c2feee42c58499fcb1c14291c7cc7c87e247c5fd2d2c06153e7a439'),
        //         'result_2' => hash_hmac($_ENV['HASH_ALGO'], 'dubois' , $_ENV['HASH_SECRET'], false),
        //     ];
        //     $message = 'Connexion réussie.';
        //     $response->getBody()->write(json_encode(['message' => $message, 'data' => $data]));
        //     return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        // });

        $app->post('/connect', ConnectUserAction::class);
        $app->post('/metric', UserMetricRetrievalAction::class);
    });
};