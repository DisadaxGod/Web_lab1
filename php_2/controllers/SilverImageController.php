<?php
require_once "SilverController.php"; // импортим TwigBaseController

class SilverImageController extends SilverController {
    

    
    public $template = "image.twig";
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        $context['image'] = "/images/silver.jpg";
        $context['type'] = "image";
        
        
        return $context;
    }
}