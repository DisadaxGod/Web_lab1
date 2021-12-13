<?php

class HistoryMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context) {
        if(!isset($_SESSION['messages'])){
            $_SESSION['messages'] = [];
        }
        $url = $_SERVER['REQUEST_URI'];
        if (count($_SESSION['messages']) > 5 ) {
            array_pop($_SESSION['messages']);
        }
        array_unshift($_SESSION['messages'],  urldecode($url));
    }
} 