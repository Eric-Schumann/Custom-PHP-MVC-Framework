<?php
    /*
    * App Core Class
    * Creates URL & loads core controller
    * URL FORMAT -/controller/method/params
    */
    class Core {
        /*This is the default controller.  You can change this to point to your own customer controller in the config.php file.*/
        protected $currentController = DEFAULT_CONTROLLER;
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            //print_r($this->getUrl());
            $url = $this->getUrl();

            //Look in controllers for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                //If exists, then set as controller
                $this->currentController = ucwords($url[0]);
                //Unset 0 index
                unset($url[0]);
            }

            //Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            //Instantiate controller class
            $this->currentController = new $this->currentController;

            //Check for method part of url
            if(isset($url[1])) {
                //Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //Get params
            $this->params = $url ? array_values($url) : [];

            //Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }