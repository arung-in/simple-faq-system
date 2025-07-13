<?php

namespace SimpleFaqSystem\Http;

use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;

class Kernel
{
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
        [$status, [$controller, $method], $vars] = $routerInfo;        
        
        return call_user_func_array([new $controller, $method], $vars);
    }
}