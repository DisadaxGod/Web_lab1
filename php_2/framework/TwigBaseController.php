<?php
require_once "BaseController.php"; 

class TwigBaseController extends BaseController {
    public $title = ""; 
    public $template = ""; 
    protected \Twig\Environment $twig; 

    // public function __construct($twig)
    // {
    //     $this->twig = $twig;
    // }
    public function setTwig($twig) {
        $this->twig = $twig;
    }
    
    public function getTemplate(){
        return $this->template;
    }
    

    public function getContext() : array
    {
        $context = parent::getContext(); 
        $query = $this->pdo->prepare("SELECT * FROM mutants_objects");
        $query->execute();
        $data = $query->fetchAll();

        $context['mutants_objects'] = $data;

       
        return $context;
    }

    
    
    public function get() {
        echo $this->twig->render($this->getTemplate(), $this->getContext());
    }
}
