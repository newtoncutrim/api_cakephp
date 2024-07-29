<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;
use Cake\Http\Middleware\CsrfProtectionMiddleware;


return function (RouteBuilder $routes): void {

    $routes->prefix('api', function (RouteBuilder $routes) {

        $routes->connect('/users', ['controller' => 'Users', 'action' => 'index'])
            ->setMethods(['get'])
            ->setExtensions(['json']);

        $routes->connect('/users/{id}', ['controller' => 'Users', 'action' => 'show'])
            ->setMethods(['get'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+'])
            ->setExtensions(['json']);

        $routes->connect('/users/{id}/edit', ['controller' => 'Users', 'action' => 'edit'])
            ->setMethods(['get', 'post', 'put', 'patch'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+'])
            ->setExtensions(['json']);

        $routes->connect('/users/{id}/delete', ['controller' => 'Users', 'action' => 'delete'])
            ->setMethods(['delete'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+'])
            ->setExtensions(['json']);

        $routes->connect('/users/add', ['controller' => 'Users', 'action' => 'store'])
            ->setMethods(['post'])
            ->setExtensions(['json']);

        $routes->fallbacks(DashedRoute::class);
    });
};
