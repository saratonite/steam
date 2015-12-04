<?php
require_once(__DIR__."/../vendor/autoload.php");

define('ROOT_PATH',__DIR__."/../");

$dotenv = new Dotenv\Dotenv(ROOT_PATH);
$dotenv->load();
$app = new \Slim\App();

$app->config(array(
    'debug' => true,
    'templates.path' => '../views'
));

// Setting Twig views
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../views', [
        //'cache' => '../cache'
    ]);

    // Instantiate and add Slim specific extension
    $view->addExtension(new Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));

    return $view;
};



use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
	'driver' => 'sqlite',
	'database' => __DIR__.'/../storage/database/database.sqlite',
	'prefix' => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
