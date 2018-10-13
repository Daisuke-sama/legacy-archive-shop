<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = include ROOT . '/config/routes.php';
    }

    public function run()
    {
        // получаем строку запроса
        $uri = $this->getUri();

        // search pattern uri in routes
        foreach ($this->routes as $routePattern => $path) {
            // comparison pattern with request uri
            if(preg_match("~$routePattern~", $uri)) {
//                echo "<br>Looking where (users request): $uri";
//                echo "<br>Looking what (from a rule): $routePattern";
//                echo "<br>Who process: $path";

                // get internal route from outer with the rule
                $internalRoute = preg_replace("~$routePattern~", $path, $uri);

//                echo "<br>Working with: $internalRoute";

                // getting the right controller
                $pathSegments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($pathSegments) . 'Controller');

                $actionName = 'action' . ucfirst(array_shift($pathSegments));

                $params = $pathSegments;

                // connect to the file of the controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once $controllerFile;
                }

                // create the controller
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $params);

                if ($result != null) {
                    break;
                }
            }
        }
    }

    /**
     * @return string of request
     */
    private function getUri()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return $uri = trim($_SERVER['REQUEST_URI'], '/');
        }

        return "";
    }
}