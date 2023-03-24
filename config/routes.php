<?php

use Slim\App;
use App\Action\EvolutionLandingViewAction;

return function (App $app) {
	$app->get('/connections', EvolutionLandingViewAction::class);

    return $app;
};
