<?php
namespace App\Action;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;
use Cake\Http\Client;
use Cake\Chronos\Chronos;
use DateTimeZone;

class EvolutionLandingViewAction
{
    public function __invoke(PhpRenderer $View, ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $View->setLayout('Layout/app.php');

		$http = new Client();

		$schedule = $http->get('https://bicc.nyc3.digitaloceanspaces.com/data/enrollment-sessions.json');

		$Sessions = $schedule->getStatusCode() === 200 ? $this->getAvailableEnrollmentSessions($schedule->getJson()) : [];

        return $View->render($response, 'Template/evolution.php', compact('Sessions'));
    }

	private function getAvailableEnrollmentSessions($schedule): ?array
	{
		$sessions = [];
		$tz = new DateTimeZone('America/New_York');

		if (array_key_exists('sessions', $schedule)) {
			foreach ($schedule['sessions'] as $ts => $session) {
				if ($session['isAvailable']) {
					$s = Chronos::createFromTimestamp($ts, $tz);
					$sessions[$ts] = $s->toDayDateTimeString();
				}
			}
		}

		return $sessions;
	}
}
