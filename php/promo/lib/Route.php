<?php

namespace promo;

/**
 * Match uri path string with action
 */
class Route
{
    private $routes;

    public function __construct()
    {
        $this->routes = [
            '/create' => new CreateAction(),
            '/append' => new AppendAction()

            // ...
            // add new route here
            // ...
        ];
    }


    /**
     * Select action by uri path string
     *
     * @param $uriPath
     * @return mixed|NotFoundAction
     */
    public function action($uriPath)
    {
        if (isset($this->routes[$uriPath])) {
            return $this->routes[$uriPath];
        } else {
            return new NotFoundAction();
        }
    }
}