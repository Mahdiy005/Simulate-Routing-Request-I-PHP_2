<?php

declare(strict_types=1);

namespace App;

use App\Exception\PathNotFoundException;
use App\Exception\RouteNotFoundException;

class Routes
{
    protected array $routes = [];
    public function addRoute(string $method, string $url, callable|array $target): self
    {
        $this->routes[$method][$url] = $target;
        return $this;
    }

    public function matchRoute()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $methodType = $_SERVER['REQUEST_METHOD'];
        if(isset($this->routes[$methodType])) {
            foreach ($this->routes[$methodType] as $route => $target) {
                if($route === $requestUri) {
                    if(is_callable($target)) {
                        return call_user_func($target);
                    }
                    if(is_array($target)) {
                        [$class, $method] = $target;
                        if(class_exists($class)) {
                            $class = new $class();
                            if(method_exists($class, $method)) {
                                return call_user_func_array($method, []);
                            }
                        }
                    }
                    throw new \App\Exception\RouteNotFoundException();
                }
            }
        }
        throw new \App\Exception\RouteNotFoundException();
    }
}
