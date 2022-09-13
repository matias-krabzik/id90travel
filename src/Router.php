<?php

namespace IdTravel\Challenge;

use Philo\Blade\Blade;

class Router
{
    protected Blade $blade;

    public function __construct()
    {
        $views = dirname(__DIR__) . '/resources/views';
        $cache = dirname(__DIR__) . '/storage/cache';
        $this->blade = new Blade($views, $cache);
    }

    private array $handlers;

    public $notFoundHandler;

    public const HTTP_GET = 'GET';
    public const HTTP_POST = 'POST';

    public function get(string $path, $handler): void
    {
        $this->addHandler(self::HTTP_GET, $path, $handler);
    }

    public function getView(string $path, $view): void
    {
        $this->addHandler(self::HTTP_GET, $path, function () use ($view) {
            echo $this->blade->view()->make($view)->render();
        });
    }

    public function post(string $path, $handler): void
    {
        $this->addHandler(self::HTTP_POST, $path, $handler);
    }

    public function addPageNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function run(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            if (!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}