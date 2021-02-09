# Sytadin

[![Packagist](https://img.shields.io/badge/packagist-install-brightgreen.svg)](https://packagist.org/packages/pgrimaud/sytadin)
[![Build Status](https://travis-ci.org/pgrimaud/sytadin.svg?branch=master)](https://travis-ci.org/pgrimaud/sytadin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pgrimaud/sytadin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pgrimaud/sytadin/?branch=master)

Real time information about road traffic on the Paris beltway.

## Usage

```
composer require pgrimaud/sytadin
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
    echo $section->getStart()->getName() . '->' . $section->getEnd()->getName() . PHP_EOL;
    echo $section->getTime() . ' (ref :' . $section->getTimeReference() . ')' . PHP_EOL;
}
//orleans->italie
//8 (ref :4)
//italie->bercy
//4 (ref :2)

//reference time
echo $route->getTimeReference() . PHP_EOL;
//6

//real time
echo $route->getTime() . PHP_EOL;
//12

//kilometers
echo $route->getKms() . PHP_EOL;
//8
```

If **Time** is superior to the **TimeReference**, it means there is some traffic jams.

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

No copyright, based & crawled on Sytadin website ([http://www.sytadin.fr](http://www.sytadin.fr))
