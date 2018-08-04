<?php
/**
 * Crystal App - Create crystal clear web applications with minimal configuration and easy to use tools.
 *
 * @author Nicholas E. <https://github.com/isupozoy> Maintainer.
 * @link   <https://github.com/isupozoy/crystal-app> Github Repository.
 */

namespace Crystal\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

/**
 * The awesome controller to welcome your users.
 */
class Welcome
{

    /**
     * The view function for the welcoming route.
     *
     * @return Response The request response.
     */
    public function view()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../views/%name%');
        $engine = new PhpEngine(new TemplateNameParser(), $loader);
        return new Response($engine->render('welcome.php'));
    }
}
