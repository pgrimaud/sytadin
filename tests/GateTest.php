<?php

use PHPUnit\Framework\TestCase;
use Sytadin\Gate;

class GateTest extends TestCase
{
    private $gates;

    public function setUp(): void
    {
        $this->gates['exterior'] = [
            'chapelle',
            'maillot',
            'auteuil',
            'orleans',
            'italie',
            'bercy',
            'bagnolet',
        ];

        $this->gates['interior'] = [
            'chapelle',
            'bagnolet',
            'bercy',
            'italie',
            'orleans',
            'auteuil',
            'maillot',
        ];
    }

    public function testListOfAvailableGates()
    {
        $types = [
            'exterior',
            'interior',
        ];

        foreach ($types as $type) {
            $gates = Gate::listGates($type);
            foreach ($this->gates[$type] as $gate) {
                $this->assertContains($gate, $gates);
            }
        }
    }

    public function testGateGetter()
    {
        $gate = new Gate('chapelle', 'start');
        $this->assertEquals('chapelle', $gate->getName());
    }

    public function testInvalidGate()
    {
        $this->expectException(InvalidArgumentException::class);
        new Gate('nop', 'start');
    }
}

