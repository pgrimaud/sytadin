<?php

use Goutte\Client;
use GuzzleHttp\{Handler\MockHandler, HandlerStack, Psr7\Response};
use PHPUnit\Framework\TestCase;
use Sytadin\Api;

class ApiTest extends TestCase
{
    private $client;

    public function setUp(): void
    {
        $fixtures = file_get_contents(__DIR__ . '/fixtures/sytadin.html');

        $response = new Response(200, [], $fixtures);
        $mock     = new MockHandler([$response]);

        $handler      = HandlerStack::create($mock);
        $guzzleClient = new \GuzzleHttp\Client(['handler' => $handler]);

        $this->client = new Client();
        $this->client->setClient($guzzleClient);
    }

    public function testValidRoute()
    {
        $api = new Api($this->client);

        $parameters = [
            'start'     => 'orleans',
            'end'       => 'bercy',
            'direction' => $api::DIRECTION_EXTERIOR,
        ];

        $api->setParameters($parameters);

        $route = $api->getRoute();

        $this->assertSame('orleans', $route->getStart()->getName());
        $this->assertSame('bercy', $route->getEnd()->getName());
    }

    public function testValidRouteInversed()
    {
        $api = new Api($this->client);

        $parameters = [
            'end'       => 'orleans',
            'start'     => 'bercy',
            'direction' => $api::DIRECTION_EXTERIOR,
        ];

        $api->setParameters($parameters);

        $route = $api->getRoute();

        $this->assertSame('bercy', $route->getStart()->getName());
        $this->assertSame('orleans', $route->getEnd()->getName());
    }

    public function testApiWithEmptyGates()
    {
        $this->expectException(InvalidArgumentException::class);

        $api = new Api($this->client);

        $parameters = [
            'end'       => '',
            'start'     => '',
            'direction' => $api::DIRECTION_EXTERIOR,
        ];

        $api->setParameters($parameters);
    }

    public function testApiWithEmptyDirection()
    {
        $this->expectException(InvalidArgumentException::class);

        $api = new Api($this->client);

        $parameters = [
            'end'       => 'bercy',
            'start'     => 'orleans',
            'direction' => 'nop',
        ];

        $api->setParameters($parameters);
    }
}

