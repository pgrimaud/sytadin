<?php
namespace Sytadin;

class Section
{
    /**
     * @var Gate
     */
    private $start;

    /**
     * @var Gate
     */
    private $end;

    /**
     * @var array
     */
    private $data;

    public function __construct(Gate $start, Gate $end, $data)
    {
        $this->start = $start;
        $this->end = $end;
        $this->data = $data;
    }

    /**
     * @return Gate
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return Gate
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->data['time'];
    }

    /**
     * @return string
     */
    public function getTimeReference()
    {
        return $this->data['timeReference'];
    }

    /**
     * @return string
     */
    public function getKms()
    {
        return $this->data['kms'];
    }
}
