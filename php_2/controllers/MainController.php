<?php
require_once "BaseMutantsTwigController.php";

class MainController extends BaseMutantsTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->query("SELECT * FROM mutants_objects");
        
        $query->execute();
        $context['mutants_objects'] = $query->fetchAll();
        
        

        return $context;
    }
}
