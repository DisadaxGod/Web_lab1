<?php
require_once "BaseMutantsTwigController.php";

class Controller404 extends BaseMutantsTwigController {
    public $template = "404.twig"; 
    public $title = "Страница не найдена";
    public function get()
    {
        http_response_code(404); 
        parent::get(); 
    }
}