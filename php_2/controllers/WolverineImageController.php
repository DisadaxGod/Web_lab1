<?php
require_once "WolverineController.php"; // импортим TwigBaseController

class WolverineImageController extends WolverineController {
    

    
    public $template = "image.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        $context['image'] = "/images/wolf.jpg";
        $context['type'] = "image";
        
        
        return $context;
    }
}