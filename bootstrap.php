<?php
/**
 * Crystal App - Create crystal clear web applications with minimal configuration and easy to use tools.
 *
 * @author Nicholas E. <https://github.com/isupozoy> Maintainer.
 * @link   <https://github.com/isupozoy/crystal-app> Github Repository.
 */

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Debug\Debug;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require __DIR__ . '/vendor/autoload.php';

// Load the core configuration file.
(new Dotenv)->load(__DIR__ . '/.env');

// Should we enable debug?
if ($_ENV['DEBUG'])
{
    Debug::enable();
    umask(0000);
}

// Create the request object.
$request = Request::createFromGlobals();

// Create the url matcher for the router.
$matcher = new UrlMatcher(include __DIR__ . '/config/Routes.php', new RequestContext());

// Compile the router.
$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

// Create the controller resolver.
$controllerResolver = new ControllerResolver();

// Create the argument resolver.
$argumentResolver = new ArgumentResolver();

// Create a new kernel handler.
$kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

// Actually execute the kernel, which turns the request into a response by dispatching events,
// calling a controller, and returning the response.
$response = $kernel->handle($request);

// Send the headers and echo the content.
$response->send();

// Trigger the kernel.terminate event.
$kernel->terminate($request, $response);
