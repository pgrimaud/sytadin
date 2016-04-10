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
     * @param null $type
     * @param null $key
     * @return mixed
     */
    public function getItems($type = null, $key = null)
    {
        if ($type && $key !== null) {
            return $this->items[$type][$key];
        } else if ($type) {
            return $this->items[$type];
        } else {
            return $this->items;
        }
    }
}