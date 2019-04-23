<?php

    class Router
    {
        private $routes = [];
        private $path;

        public function __construct(string $sourcePath)
        {
            $this->routes = $this->getRoutes(); 
            $this->path = $sourcePath;
        }

        public function start()
        {
            $requestURI = $this->getRequestURI();
            $isFounded = false;

            foreach($this->routes as $pattern => $handler)
            {
                if (preg_match("~$pattern~", $requestURI))
                {
                    $internalRoute = preg_replace("~$pattern~", $handler[0], $requestURI);

                    $segments = explode('/', $internalRoute);

                    $controllerName = ucfirst(array_shift($segments)).'Controller';
                    $actionName = 'action'.ucfirst(array_shift($segments));

                    $parameters = $segments;

                    $controllerFile = $this->path.'/controllers/'.$controllerName.'.php';

                    if (!file_exists($controllerFile))
                        continue;

                    if ($handler[1] != count($parameters))
                        continue;

                    $controllerObject = new $controllerName;

                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                    if ($result === true) 
                    {
                        $isFounded = true;
                        break;
                    }
                    else
                    {
                        $isFounded = true;
                        require_once($this->path.'/views/404/index.php');
                        break;
                    }

                }
            }

            if (!$isFounded)
            {
                require_once($this->path.'/views/404/index.php');
            }
        }

        private function getRequestURI():string
        {
            if (!empty($_SERVER['REQUEST_URI']))
                return trim($_SERVER['REQUEST_URI'], '/');
        }

        private function getRoutes():array
        {
            return array
            (
                "user/exit" => ["user/exit", 0],
                "user/register" => ["user/register", 0],
                "user/authorize" => ["user/authorize", 0],
                "post/([0-9]+)" => ["post/view/$1", 1],
                "post/add" => ["post/add", 0],
                "post/added" => ["post/added", 0],
                "post/edit/([0-9]+)" => ["post/edit/$1", 1],
                "post/edited" => ["post/edited", 0],
                "post/search" => ["post/search", 0],
                "post/delete/([0-9]+)" => ["post/delete/$1", 1],
                "post/([a-z]+)" => ["post/category/$1", 1],
                "" => ["site/index", 0]
            );
        }
    }

?>