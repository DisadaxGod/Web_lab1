<?php
require_once "BaseMutantsTwigController.php";

class MainController extends BaseMutantsTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        if(isset($_GET['type'])){
            $query = $this->pdo->prepare("SELECT * FROM mutants_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        }else {
            $query = $this->pdo->query("SELECT * FROM mutants_objects");
        }
        
        $context['mutants_objects'] = $query->fetchAll();
        

        return $context;
    }
}
