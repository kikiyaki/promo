<?php

namespace promo;

/**
 * Match uri string with action
 */
class Route
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            '/create' => new CreateAction()

            // ...
            // add new route here
            // ...
        ];
    }


    /**
     * Select action by uri string
     *
     * @param $uri
     * @return mixed|NotFoundAction
     */
    public function action($uri)
    {
        if (isset($this->routes[$uri])) {
            return $this->routes[$uri];
        } else {
            return new NotFoundAction();
        }
    }
}