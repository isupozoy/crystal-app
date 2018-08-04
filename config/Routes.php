<?php
/**
 * Crystal App - Create crystal clear web applications with minimal configuration and easy to use tools.
 *
 * @author Nicholas E. <https://github.com/isupozoy> Maintainer.
 * @link   <https://github.com/isupozoy/crystal-app> Github Repository.
 */

// This file is automatically managed by the console.

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Crystal\Controller\Welcome as WelcomeController;

$routes = new RouteCollection();

$routes->add('welcome', new Route('/', array(
    '_controller' => [WelcomeController::class, 'view']
), array(), array(), '', array('https')));

return $routes;
