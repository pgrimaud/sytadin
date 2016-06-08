<?php
namespace Sytadin\Api\tests;

use Sytadin\Gate;
use Sytadin\Route;
use Sytadin\Section;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRoute()
    {
        $startGate = new Gate('chapelle', 'start');
        $endGate = new Gate('orleans', 'end');

        $data = [
            'time' => '8 min',
            'timeReference' => '5 min',
            'kms' => 5
        ];

        $route = new Route($startGate, $endGate, 'interior');

        $this->assertSame('chapelle', $route->getStart()->getName());
        $this->assertSame('orleans', $route->getEnd()->getName());
        $this->assertSame('interior', $route->getWay());

        $route->setKms(5);
        $this->assertSame(5, $route->getKms());

        $section = new Section($startGate, $endGate, $data);
        $route->setSection($section);
        $route->setSection($section);
        $this->assertCount(2, $route->getSections());

        $route->setTime('8 min');
        $this->assertSame('8 min', $route->getTime());

        $route->setTimeReference('5 min');
        $this->assertSame('5 min', $route->getTimeReference());

    }
}

