<?php

namespace App;

use Authentication\AuthenticationService;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Slim\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;
use Authentication\AuthenticationServiceInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use App\Middleware\SessionMiddleware;
use Authentication\Identifier\IdentifierInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\Psr17\GuzzlePsr17Factory;
use Slim\Interfaces\RouteParserInterface;
use Cake\Http\Session;
use Middlewares\TrailingSlash;
use Predis\ClientInterface as CacheClient;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\AbstractAdapter as CacheAdapter;
use App\Component\Session\RedisSession;
use App\Middleware\SentryMiddleware;
use Cake\Core\Configure;
use App\Model\Entity\User;

use function DI\factory;
use function DI\autowire;
use function DI\get;

class Application
{
    private App $app;

    public function __construct(App $app)
    {
        $this->initialize();

        $app = $this->registerRoutes($app);
        $app = $this->registerMiddleware($app);

        $this->app = $app;
    }

    public function initialize(): void
    {
        require_once CONFIG . 'initialize.php';
    }

    public static function create(): App
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(self::getDependencies());

        $container = $builder->build();
        return (new Application(Bridge::create($container)))->getApp();
    }

    private function getApp(): App
    {
        return $this->app;
    }

    private function registerRoutes(App $app): App
    {
        $routes = require_once CONFIG . 'routes.php';
        return $routes($app);
    }

    private function registerMiddleware(App $app): App
    {
        $app->add(SessionMiddleware::class);
        $app->add((new TrailingSlash(false))->redirect());
        $app->addErrorMiddleware(Configure::read('debug'), true, true);

        return $app;
    }

    /**
     * @return array
     * @todo: move options to a seperate settings file in config directory
     */
    private static function getDependencies(): array
    {
        return [
            LoggerInterface::class => factory(function () {
                $logger = new Logger('nCompass');

                $path = filter_var(getenv('NC_APP_LOG'), FILTER_VALIDATE_BOOLEAN) ? LOGS . 'app.log' : 'php://stdout';
                $logger->pushHandler(new StreamHandler($path, Logger::DEBUG));

                return $logger;
            }),
            PhpRenderer::class => autowire()
                ->constructor(APP . 'View'),
            AuthenticationServiceInterface::class => factory(function (ContainerInterface $c) {
                $auth = new AuthenticationService();

                $auth->setConfig([
                    'identityClass' => User::class,
                    'unauthenticatedRedirect' => $c->get(App::class)->getRouteCollector()->getRouteParser()->urlFor('user.login'),
                    'queryParam' => 'redirect',
                ]);

                $fields = [
                    IdentifierInterface::CREDENTIAL_USERNAME => 'username',
                    IdentifierInterface::CREDENTIAL_PASSWORD => 'password',
                ];

                $auth->loadAuthenticator('Authentication.Session', [
                    'identify' => true,
                ]);
                $auth->loadAuthenticator('Authentication.Form', [
                    'fields' => $fields,
                    'loginUrl' => $c->get(App::class)->getRouteCollector()->getRouteParser()->urlFor('user.login'),
                ]);

                $auth->loadIdentifier('Authentication.Password', compact('fields'));

                return $auth;
            }),
            Session::class => factory(function (ContainerInterface $c) {
                $config = [
                    'defaults' => 'cache',
                    'timeout' => 30,
                    'handler' => [
                        'engine' => RedisSession::class,
                        'cache' => $c->get(CacheAdapter::class),
                    ],
                ];

                return Session::create($config);
            }),
            AuthenticationMiddleware::class => autowire()
                ->constructorParameter('subject', get(AuthenticationServiceInterface::class)),
            ResponseFactoryInterface::class => factory(function () {
                return GuzzlePsr17Factory::getResponseFactory();
            }),
            RouteParserInterface::class => factory(function (ContainerInterface $c) {
                return $c->get(App::class)->getRouteCollector()->getRouteParser();
            }),
            CacheClient::class => factory(function () {
                return new \Predis\Client([
                    [
                        'scheme' => getenv('NC_REDIS_SCHEME'),
                        'host' => getenv('NC_REDIS_HOST'),
                        'port' => getenv('NC_REDIS_PORT'),
                        'username' => getenv('NC_REDIS_USERNAME'),
                        'password' => getenv('NC_REDIS_PASSWORD'),
                        'database' => 0,
                        'ssl' => [
                            'verify_peer' => false,
                            'allow_self_signed' => true,
                        ],
                    ]
                ],
                [
                    'options' => [
                        'cluster' => 'redis',
                        'parameters' => [
                            'scheme' => getenv('NC_REDIS_SCHEME'),
                            'host' => getenv('NC_REDIS_HOST'),
                            'port' => getenv('NC_REDIS_PORT'),
                            'username' => getenv('NC_REDIS_USERNAME'),
                            'password' => getenv('NC_REDIS_PASSWORD'),
                            'database' => 0,
                            'ssl' => [
                                'verify_peer' => false,
                                'allow_self_signed' => true,
                            ],
                        ],
                    ]
                ]);
            }),
            CacheAdapter::class => factory(function (ContainerInterface $c) {
                $client = $c->get(CacheClient::class);
                return new RedisAdapter($client);
            }),
        ];
    }
}
