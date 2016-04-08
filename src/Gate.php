<?php
namespace Sytadin;

class Gate
{
    /**
     * @var string
     */
    private $gate;

    /**
     * @var string
     */
    private $type;

    /**
     * Gate constructor.
     * @param $gateName string
     */
    public function __construct($gateName, $type)
    {
        $this->type = $type;
        $this->setGate($gateName);
    }

    /**
     * @return string
     */
    public function getGate()
    {
        return $this->gate;
    }

    /**
     * @param $gateName
     */
    private function setGate($gateName)
    {
        if (!in_array($gateName, $this->gates())) {
            throw new \InvalidArgumentException('Parameter ' . $this->type . ' is invalid (' . $gateName . ')');
        } else {
            $this->gate = $gateName;
        }
    }

    /**
     * @return array
     */
    public function gates()
    {
        //order exterior way
        return [
            'chapelle',
            'maillot',
            'auteuil',
            'orleans',
            'italie',
            'bercy',
            'bagnolet',
        ];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}