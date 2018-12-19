<?php
    class Router{
        private $routes;

        public function __construct(){
            $routersPath = ROOT.'/config/routers.php';
            $this->routes = include($routersPath);
        }
        /*
         * returns request string
         * */
        private function getURI(){
            if (!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run(){
            // получить строку запроса
            $uri = $this->getUri();
            echo $this->getURI();
            // получить наличие такого запроса в routes.php
            foreach ($this->routes as $uriPattern => $path){

                //сравниваем $uriPattern и uri
                if (preg_match("~$uriPattern~", $uri)){

//                    echo '<br>Где ищем (запрос набрал пользователь): '.$uri;
//                    echo '<br>что ищем (совпадение из правил) '.$uriPattern;
//                    echo '<br>кто обрабатывает '.$path;

                   // получаем внутрений путь из внешнего согласно правилу(regExp)
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                    // определить какой контролер и action обрабатывают запрос

                    $segments = explode('/', $internalRoute);

                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = ucfirst($controllerName);

                    $actionName = 'action'.ucfirst(array_shift($segments));


                    $parameters = $segments;
                    
                    // Подключить файл класса контролера

                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                    if (file_exists($controllerFile)){
                        include_once ($controllerFile);
                    }

                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$actionName($parameters);
                    if ($result != null){
                        break;
                    }
                }
            }
        }
    }

