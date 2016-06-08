<?php
namespace Sytadin;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Api
{
    CONST DIRECTION_INTERIOR = 'interior';
    CONST DIRECTION_EXTERIOR = 'exterior';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $entryPoint;

    /**
     * @var array
     */
    private $dataFetched;

    /**
     * @var integer
     */
    private $row = -1;

    /**
     * @var Route
     */
    private $route;

    /**
     * @var SectionCollection
     */
    private $sectionCollection;

    /**
     * Api constructor.
     * @param Client $client
     * @param null $entryPoint
     */
    public function __construct(Client $client = null, $entryPoint = null)
    {
        $this->client = $client ?: new Client();
        $this->entryPoint = $entryPoint ?: 'http://www.sytadin.fr/sys/temps_de_parcours.jsp.html?type=secteur';
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters = [])
    {
        $this->validParameters($parameters);

        $this->client->setHeader('HTTP_USER_AGENT',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:45.0) Gecko/20100101 Firefox/45.0');
        $crawler = $this->client->request('GET', $this->entryPoint);
        
        $crawler->filter('.tps_parcours.BP .secteurTable tbody tr td')->each(function (Crawler $node, $i) {

            $text = $node->text();

            if (!($i % 7)) {
                $this->row++;
            } else {
                $way = ($i <= 49) ? self::DIRECTION_EXTERIOR : self::DIRECTION_INTERIOR;
                $text = str_replace(["é", "\n", "\r", "\t", " "], ['e', ''], $text);
                $this->dataFetched[$this->row][$way][] = $text;
            }

        });

        $this->sanitizeContent();
        $this->calculateRoute();
    }

    private function sanitizeContent()
    {
        $results = $this->dataFetched;
        $this->sectionCollection = new SectionCollection();

        foreach ($results as $way) {
            foreach ($way as $wayName => $gate) {
                //unset 'BP'
                unset($gate[0]);
                $gate = array_values($gate);

                preg_match('/P.(.*)\(.*\)=>P.(.*)\(.*\)/x', $gate[0], $gates);


                $section = new Section(new Gate(strtolower($gates[1]), 'start'),
                    new Gate(strtolower($gates[2]), 'end'),
                    [
                        'time' => (int)str_replace('mn', '', $gate[1]),
                        'timeReference' => (int)str_replace('mn', '', $gate[2]),
                        'kms' => (int)$gate[3]
                    ]);

                $this->sectionCollection->add($section, $wayName);
            }
        }
    }

    /**
     * @param array $parameters
     * @throws \InvalidArgumentException
     */
    public function validParameters($parameters = [])
    {
        $fieldsToCheck = [
            'start',
            'end',
            'direction'
        ];

        foreach ($fieldsToCheck as $field) {
            if (empty($parameters[$field])) {
                throw new \InvalidArgumentException('Parameter ' . $field . ' is missing');
            }
        }

        $gatesToCheck = [
            'start',
            'end'
        ];

        foreach ($gatesToCheck as $gate) {
            $this->$gate = new Gate($parameters[$gate], $gate);
        }

        if ($parameters['direction'] == self::DIRECTION_EXTERIOR
            || $parameters['direction'] == self::DIRECTION_INTERIOR
        ) {
            $this->route = new Route($this->start, $this->end, $parameters['direction']);
        } else {
            throw new \InvalidArgumentException('Parameter direction is invalid');
        }
    }

    private function calculateRoute()
    {
        $referenceStart = array_search($this->route->getStart()->gate, Gate::listGates($this->route->getWay()));
        $referenceEnd = array_search($this->route->getEnd()->gate, Gate::listGates($this->route->getWay()));

        $dataCalculated = [
            'time' => 0,
            'timeReference' => 0,
            'kms' => 0
        ];

        if ($referenceStart >= $referenceEnd) {
            while ($referenceStart < count(Gate::listGates($this->route->getWay()))) {
                $section = $this->sectionCollection->getItems($this->route->getWay(),
                    $referenceStart);
                $this->route->setSection($section);
                foreach ($section->getData() as $field => $number) {
                    $dataCalculated[$field] += (int)$number;
                }
                $referenceStart++;
            }
            //and restart
            $cursor = 0;
            while ($cursor < $referenceEnd) {
                $section = $this->sectionCollection->getItems($this->route->getWay(), $cursor);
                $this->route->setSection($section);
                foreach ($section->getData() as $field => $number) {
                    $dataCalculated[$field] += (int)$number;
                }
                $cursor++;
            }
        } else {
            while ($referenceStart < $referenceEnd) {
                $section = $this->sectionCollection->getItems($this->route->getWay(), $referenceStart);
                $this->route->setSection($section);
                foreach ($section->getData() as $field => $number) {
                    $dataCalculated[$field] += (int)$number;
                }
                $referenceStart++;
            }
        }

        foreach ($dataCalculated as $field => $value) {
            $this->route->{'set' . ucwords($field)}($value);
        }
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }
}