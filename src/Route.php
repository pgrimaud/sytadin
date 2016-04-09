<?php
namespace Sytadin;

class Route
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
     * @var string@
     */
    private $way;

    /**
     * Route constructor.
     * @param Gate $start
     * @param Gate $end
     * @param $way
     */
    public function __construct(Gate $start, Gate $end, $way)
    {
        $this->start = $start;
        $this->end = $end;
        $this->way = $way;
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
     * @return string
     */
    public function getWay()
    {
        return $this->way;
    }
}