<?php
require_once "BaseController.php"; 

class TwigBaseController extends BaseController {
    public $title = ""; 
    public $template = ""; 
    protected \Twig\Environment $twig; 

    public function __construct($twig)
    {
        $this->twig = $twig;
         
    }
    
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title; 
        $context['menu'] = [ 
            [
                "title" => "Росомаха",
                "url-main" => "/wolverine",
                "url-image" => "/wolverine/image",
                "url-info" => "/wolverine/info",
            ],
            [
                "title" => "Ртуть",
                "url-main" => "/quicksilver",
                "url-image" => "/quicksilver/image",
                "url-info" => "/quicksilver/info",
            ]
        ]; 
        return $context;
    }
    
    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}
