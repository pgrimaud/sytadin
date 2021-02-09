<?php

declare(strict_types=1);

namespace Sytadin;

class Section
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
     * @var array
     */
    private array $data;

    /**
     * @param Gate $start
     * @param Gate $end
     * @param array $data
     */
    public function __construct(Gate $start, Gate $end, array $data)
    {
        $this->start = $start;
        $this->end   = $end;
        $this->data  = $data;
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
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->data['time'];
    }

    /**
     * @return string
     */
    public function getTimeReference(): string
    {
        return $this->data['timeReference'];
    }

    /**
     * @return int
     */
    public function getKms(): int
    {
        return $this->data['kms'];
    }
}
