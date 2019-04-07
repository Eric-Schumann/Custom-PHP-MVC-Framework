<?php
    /*This is the default controller.*/
    class Pages extends Controller {
        public function __construct() {
        }

        public function index() {


            $data = [
                'title' => 'Home Page!',
            ];

            $this->view('pages/index', $data);
        }

        public function about() {
            $data = [
                'title' => 'About!'
            ];
            $this->view('pages/about', $data);
        }
    }