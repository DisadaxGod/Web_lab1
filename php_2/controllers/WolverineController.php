<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class WolverineController extends TwigBaseController {
    

    public $title = "Росомаха";
    public $template = "__object.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title; 
        $context['name'] = "wolverine";
        
        
        return $context;
    }
}