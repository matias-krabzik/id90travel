<?php

namespace IdTravel\Challenge;

use Jenssegers\Blade\Blade;

class Router
{
    private array $handlers;

    public $notFoundHandler;

    public const HTTP_GET = 'GET';
    public const HTTP_POST = 'POST';

    public function view(string $path, string $view): void
    {
        $this->addHandler(self::HTTP_GET, $path, null, $view);
    }

    public function get(string $path, $handler): void
    {
        $this->addHandler(self::HTTP_GET, $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addHandler(self::HTTP_POST, $path, $handler);
    }

    public function addPageNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler = null, string $view = null): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'view' => $view,
            'handler' => $handler
        ];
    }

    public function run(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $view = null;
        $callback = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
                $view = $handler['view'];
            }
        }

        if ($view) {
            echo view($view);
            return;
        }

        if (is_string($callback)) {
            $callback = explode('@', $callback);
            if (is_array($callback)) {
                $class = array_shift($callback);
                $handler = new $class();
                $method = array_shift($callback);
                $callback = [$handler, $method];
            }
        }

        if (!$callback) {
            header('HTTP/1.1 404 Not Found');
            if (!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}