<?php
use App\Application;
use Slim\Factory\Psr17\GuzzlePsr17Factory;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/paths.php';

$app = Application::create();
$app->run((GuzzlePsr17Factory::getServerRequestCreator())->createServerRequestFromGlobals());
