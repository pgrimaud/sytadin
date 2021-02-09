<?php

use PHPUnit\Framework\TestCase;
use Sytadin\{Gate, Section, SectionCollection};

class SectionCollectionTest extends TestCase
{
    public function testAddGateToCollection()
    {
        $startGate = new Gate('chapelle', 'start');
        $endGate   = new Gate('orleans', 'end');
        $section   = new Section($startGate, $endGate, []);

        $collection = new SectionCollection();
        $collection->add($section, 'interior');
        $collection->add($section, 'exterior');
        $collection->add($section, 'exterior');

        $this->assertArrayHasKey('interior', $collection->getItems());
        $this->assertArrayHasKey('exterior', $collection->getItems());

        $this->assertCount(1, $collection->getItems('interior'));
        $this->assertCount(2, $collection->getItems('exterior'));

        $this->assertCount(2, $collection->getItems());

        $this->assertCount(1, [$collection->getItems('interior', 0)]);
    }
}

