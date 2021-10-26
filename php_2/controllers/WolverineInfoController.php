<?php
require_once "WolverineController.php"; // импортим TwigBaseController

class WolverineInfoController extends WolverineController {
    

    
    public $template = "wolf_info.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        
        $context['text'] = "/views/wolf_info.php";
        $context['type'] = "text";
        
        
        return $context;
    }
}