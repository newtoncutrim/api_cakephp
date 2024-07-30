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


        $routes->connect('/posts', ['controller' => 'Posts', 'action' => 'index'])
            ->setMethods(['get'])
            ->setExtensions(['json']);

        $routes->connect('/posts/{id}', ['controller' => 'Posts', 'action' => 'show'])
            ->setMethods(['get'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+'])
            ->setExtensions(['json']);
        $routes->connect('/posts/{id}/edit', ['controller' => 'Posts', 'action' => 'edit'])
            ->setMethods(['get', 'post', 'put', 'patch'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+']);
        $routes->connect('/posts/{id}/delete', ['controller' => 'Posts', 'action' => 'delete'])
            ->setMethods(['delete'])
            ->setPass(['id'])
            ->setPatterns(['id' => '[0-9]+']);
        $routes->connect('/posts/add', ['controller' => 'Posts', 'action' => 'store'])
            ->setMethods(['post'])
            ->setExtensions(['json']);

        $routes->fallbacks(DashedRoute::class);
    });

    $routes->connect('/', ['controller' => 'Home', 'action' => 'index'])
        ->setMethods(['get']);

    $routes->connect('/posts/view/{id}', ['controller' => 'Home', 'action' => 'view'])
        ->setMethods(['get'])
        ->setPass(['id']);


};
