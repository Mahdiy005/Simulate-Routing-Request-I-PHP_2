<?php

declare(strict_types=1);

use App\Routes;

require __DIR__.'/vendor/autoload.php';


$route = new Routes();

$route->addRoute('GET', '/oop3/blog', [App\Classes\Home::class, 'index'])
      ->addRoute('GET', '/oop3/ok',[App\Classes\Invoice::class, 'index'])
      ->addRoute('GET', '/oop3/login', [\App\Classes\Invoice::class, 'create']);

echo $route->matchRoute();