# Wolnelektury API package to Laravel
Package is still under construction

### Installation

Require package by composer

```
composer require olek/wolnelektury
```

Service Provider

```
'providers' => [
    ...
    Olekjs\Wolnelektury\ServiceProvider::class,
],
```

Facades

```
'aliases' => [
   ...
   'Wolnelektury' => Olekjs\Wolnelektury\Facade::class,
],
```

## Publish config

```
php artisan vendor:publish --provider=Olekjs\\Wolnelektury\\ServiceProvider
```


### Usage

```
use Olekjs\Wolnelektury\Facade as Wolnelektury;

Wolnelektury::getBook('potop');
```

