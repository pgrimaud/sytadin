<?php

declare(strict_types=1);

namespace Sytadin;

class Route
{
    /**
     * @var Gate
     */
    private Gate $start;

    /**
     * @var Gate
     */
    private Gate $end;

    /**
     * @var string
     */
    private string $way;

    /**
     * @var array
     */
    private array $sections = [];

    /**
     * @var int
     */
    private int $time;

    /**
     * @var int
     */
    private int $timeReference;

    /**
     * @var int
     */
    private int $kms;

    /**
     * @param Gate $start
     * @param Gate $end
     * @param string $way
     */
    public function __construct(Gate $start, Gate $end, string $way)
    {
        $this->start = $start;
        $this->end   = $end;
        $this->way   = $way;
    }

    /**
     * @return Gate
     */
    public function getStart(): Gate
    {
        return $this->start;
    }

    /**
     * @return Gate
     */
    public function getEnd(): Gate
    {
        return $this->end;
    }

    /**
     * @return string
     */
    public function getWay(): string
    {
        return $this->way;
    }

    /**
     * @param Section $section
     */
    public function setSection(Section $section): void
    {
        $this->sections[] = $section;
    }

    /**
     * @return array
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $timeReference
     */
    public function setTimeReference(int $timeReference): void
    {
        $this->timeReference = $timeReference;
    }

    /**
     * @return int
     */
    public function getTimeReference(): int
    {
        return $this->timeReference;
    }

    /**
     * @param int $kms
     */
    public function setKms(int $kms): void
    {
        $this->kms = $kms;
    }

    /**
     * @return int
     */
    public function getKms(): int
    {
        return $this->kms;
    }
}
