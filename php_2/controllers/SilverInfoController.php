<?php
require_once "SilverController.php"; // импортим TwigBaseController

class SilverInfoController extends SilverController {
    

    
    public $template = "silver_info.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        
        $context['text'] = "/views/silver_info.php";
        $context['type'] = "text";
        
        
        return $context;
    }
}