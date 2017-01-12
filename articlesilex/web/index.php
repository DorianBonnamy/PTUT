<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = new Silex\Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

/**
 * DEPENDANCES
 */
$app['connection'] = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => 'article'
];

$app['doctrine_config'] = Setup::createYAMLMetadataConfiguration([__DIR__ . '/../Site/config'], true);
$app['em'] = function ($app) {
    return EntityManager::create($app['connection'], $app['doctrine_config']);
};

/**
 * ROUTES
 */

$app->get('/', 'DUT\\Controllers\\ItemsController::indexAction');

$app->get('/remove/{index}', 'DUT\\Controllers\\ItemsController::removeAction');

$app->post('/add', 'DUT\\Controllers\\ItemsController::addAction');

$app->register(new Silex\Provider\TwigServiceProvider(), ['twig.path' => __DIR__.'/../views',]);


$app['debug'] = true;
$app->run();
