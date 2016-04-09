<?php
namespace Sytadin;

class SectionCollection
{
    /**
     * @var array
     */
    private $items;

    public function add(Section $section, $type)
    {
        $this->items[$type][] = $section;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }
}