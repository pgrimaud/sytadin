# Sytadin

[![Packagist](https://img.shields.io/badge/packagist-install-brightgreen.svg)](https://packagist.org/packages/pgrimaud/sytadin)

Real time information about road traffic on the Paris beltway.

Based on site http://www.sytadin.fr

## Usage

```
compose require pgrimaud/sytadin

```

```php

$api = new \Sytadin\Api();

$parameters = [
    'start' => 'orleans',
    'end' => 'bercy',
    'direction' => $api::DIRECTION_EXTERIOR
];

$api->setParameters($parameters);
$route = $api->getRoute();

echo $route->getStart()->getName() . PHP_EOL;
//orleans

echo $route->getEnd()->getName() . PHP_EOL;
//bercy

foreach ($route->getSections() as $section) {
    echo $section->getStart()->getName() . PHP_EOL;
    //orleans
	//italie
}

//real time
echo $route->getTimeReference() . PHP_EOL;
//12

//reference time
echo $route->getTime() . PHP_EOL;
//6

//kilometers
echo $route->getKms() . PHP_EOL;
//8

```

If **time** is superior to the **TimeReference**, it means there is some traffic jams.

## Gates available

```php
foreach (\Sytadin\Gate::listGates() as $gate) {
    echo $gate . PHP_EOL;
}
```

```
chapelle
maillot
auteuil
orleans
italie
bercy
bagnolet

```

## Copyright

No copyright, based & crawled on Sytadin website.