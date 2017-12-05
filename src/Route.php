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
     * @var string
     */
    private $way;

    /**
     * @var array
     */
    private $sections = [];

    /**
     * @var integer
     */
    private $time;

    /**
     * @var integer
     */
    private $timeReference;

    /**
     * @var integer
     */
    private $kms;

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

    /**
     * @param Section $section
     */
    public function setSection(Section $section)
    {
        $this->sections[] = $section;
    }

    /**
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param int $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param int $timeReference
     */
    public function setTimeReference($timeReference)
    {
        $this->timeReference = $timeReference;
    }

    /**
     * @return int
     */
    public function getTimeReference()
    {
        return $this->timeReference;
    }

    /**
     * @param int $kms
     */
    public function setKms($kms)
    {
        $this->kms = $kms;
    }

    /**
     * @return int
     */
    public function getKms()
    {
        return $this->kms;
    }
}
