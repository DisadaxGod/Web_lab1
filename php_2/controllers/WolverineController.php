<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class WolverineController extends TwigBaseController {
    $title = "Росомаха";
    $template = "__object.twig";
    $context['name'] = "wolverine";

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title; 
        
        return $context;
    }
}