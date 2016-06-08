<?php
namespace Sytadin\Api\tests;

use Sytadin\Gate;
use Sytadin\Section;

class SectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSection()
    {
        $startGate = new Gate('chapelle', 'start');
        $endGate = new Gate('orleans', 'end');

        $data = [
            'time' => '8 min',
            'timeReference' => '5 min',
            'kms' => 5
        ];

        $section = new Section($startGate, $endGate, $data);

        $this->assertSame('8 min', $section->getTime());
        $this->assertSame('5 min', $section->getTimeReference());
        $this->assertSame(5, $section->getKms());

        $this->assertSame('chapelle', $section->getStart()->getName());
        $this->assertSame('orleans', $section->getEnd()->getName());

        $this->assertEquals($data, $section->getData());

    }
}

