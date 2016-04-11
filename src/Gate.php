<?php
namespace Sytadin;

class Gate
{
    /**
     * @var string
     */
    public $gate;

    /**
     * @var string
     */
    public $type;

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
     * @param $gateName
     */
    private function setGate($gateName)
    {
        if (!in_array($gateName, $this->listGates())) {
            throw new \InvalidArgumentException('Parameter ' . $this->type . ' is invalid (' . $gateName . ')');
        } else {
            $this->gate = $gateName;
        }
    }

    /**
     * @return array
     */
    public static function listGates($way = 'exterior')
    {
        $gatesExterior = [
            'chapelle',
            'maillot',
            'auteuil',
            'orleans',
            'italie',
            'bercy',
            'bagnolet',
        ];

        $gatesInterior = [
            'chapelle',
            'bagnolet',
            'bercy',
            'italie',
            'orleans',
            'auteuil',
            'maillot',
        ];

        return $way == 'exterior' ? $gatesExterior : $gatesInterior;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->gate;
    }
}