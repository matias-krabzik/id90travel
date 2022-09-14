<?php

namespace Tests;

use GuzzleHttp\Client;
use Symfony\Component\Process\Process;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase as BaseTestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class TestCase extends BaseTestCase
{
    private static Process $process;
    public static Client $client;

    public static function setUpBeforeClass(): void
    {
        self::$client = new Client(['http_errors' => false]);
        self::$process = new Process(['php', '-S', 'localhost:8881', '-t', 'public/']);
        self::$process->start();
        usleep(100000); //wait for server to get going
    }

    protected function tearDown(): void
    {
        self::$process->stop();
    }

    /**
    * @throws GuzzleException
    */
    public function get($path, $params): \Psr\Http\Message\ResponseInterface
    {
        return self::$client->get(
            'http://localhost:8881' . $path,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'charset' => 'utf-8'
                ],
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function post($path, $params): \Psr\Http\Message\ResponseInterface
    {
        return self::$client->post(
            'http://localhost:8881' . $path,
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'charset' => 'utf-8'
                ],
                'form_params' => $params
            ],
        );
    }
}
