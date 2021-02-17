<?php

declare(strict_types=1);

namespace Sytadin;

class SectionCollection
{
    /**
     * @var array
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @param Section $section
     * @param string  $type
     */
    public function add(Section $section, string $type): void
    {
        $this->items[$type][] = $section;
    }

    /**
     * @param string|null $type
     * @param int|null    $key
     *
     * @return array|mixed
     */
    public function getItems(string $type = null, int $key = null)
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
