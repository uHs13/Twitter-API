<?php
require_once 'vendor/autoload.php';

use Project\Session\Session;
use Slim\Container;
use Slim\App;

try {

	$session = new Session();

	$session->setName('TwitterAPI' . $_SERVER['REMOTE_ADDR']);

	$session->start();

} catch (Exception $e) {

	var_dump($e->getMessage());

}

$configuration = [

	'settings' => [

		'displayErrorDetails' => true

	]

];

$container = new Container($configuration);

$container['notFoundHandler'] = function ($container) {

	return function ($req, $res) use ($container) {

		return $res->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(['info' => 'page not found']));

	};

};

$container['displayErrorDetails'] = true;
$container['debug'] = true;

$app = new App($container);

require_once 'routes/main/display.php';
require_once 'routes/main/action.php';

$app->run();