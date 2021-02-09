<?php

declare(strict_types=1);

namespace Sytadin;

class Gate
{
    /**
     * @var string
     */
    public string $gate;

    /**
     * @var string
     */
    public string $type;

    /**
     * @param string $gateName
     * @param string $type
     */
    public function __construct(string $gateName, string $type)
    {
        $this->type = $type;
        $this->setGate($gateName);
    }

    /**
     * @param string $gateName
     */
    private function setGate(string $gateName): void
    {
        if (!in_array($gateName, $this->listGates())) {
            throw new \InvalidArgumentException('Parameter ' . $this->type . ' is invalid (' . $gateName . ')');
        } else {
            $this->gate = $gateName;
        }
    }

    /**
     * @param string $way
     * @return array
     */
    public static function listGates(string $way = 'exterior'): array
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
    public function getName(): string
    {
        return $this->gate;
    }
}
