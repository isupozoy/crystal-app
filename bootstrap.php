<?php
/*|*
 *| A powerful web skeleton built using Symfony.
 *|
 *| @author Nicholas E. <https://github.com/isupozoy> Maintainer.
 *| @link   <https://github.com/isupozoy/web-skeleton> Github Repository.
 *|*/

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Debug\Debug;

require_once __DIR__ . '/vendor/autoload.php';
(new Dotenv())->load(__DIR__ . '/.env');
if ($_ENV['DEBUG'])
{
    Debug::enable();
}
$isDevMode = $_ENV['DEBUG'];
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/src/orm'), $isDevMode);
$dbParams = array(
    'driver'   => $_ENV['DB_DRIVER'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname'   => $_ENV['DB_NAME'],
);
$entityManager = EntityManager::create($conn, $config);
