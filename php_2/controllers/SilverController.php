<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class SilverController extends TwigBaseController {
    

    public $title = "Ртуть";
    public $template = "__object.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title; 
        $context['name'] = "quicksilver";
        
        
        return $context;
    }
}