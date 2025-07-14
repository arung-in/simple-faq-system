<?php

namespace SimpleFaqSystem\Http;

use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;
use SimpleFaqSystem\Controllers\AbstractController;
use SimpleFaqSystem\Database\Connection;
use FastRoute\Dispatcher;

class Kernel
{

    protected ?Connection $connection = null;

    public function __construct()
    {
        $config = include BASE_PATH . '/database/config.php';
        $this->connection = Connection::getInstance ($config['database']);
            
    }

    public function handle(Request $request): Response
    {
        
        // Used simpleDispatcher to define routes 
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {
            
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                // [$method, $uri, $handler] = $route;
                // $routeCollector->addRoute($method, $uri, $handler);
                $routeCollector->addRoute(...$route);
            }
           

        });

        $routerInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri());
        if ($routerInfo[0] === Dispatcher::NOT_FOUND) {
            return new Response('Not Found', 404);
        } elseif ($routerInfo[0] === Dispatcher::METHOD_NOT_ALLOWED) {
            return new Response('Method Not Allowed', 405);
        }

        [$status, [$controller, $method], $vars] = $routerInfo;        
        
        $controller = new $controller;
        
        if($controller instanceof AbstractController) {
            $controller->setRequest($request);
        }

        return call_user_func_array([$controller, $method], $vars);
    }
}