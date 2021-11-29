<?php
require_once "BaseMutantsTwigController.php";

class MutantObjectUpdateController extends BaseMutantsTwigController {
    public $template = "mutant_object_update.twig";


    public function get(array $context){


        $id = $this->params['id'];

        $sql = <<<EOL
        SELECT * FROM mutants_objects WHERE id = :id
        EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();
        $context['object']=$data;
        $context = parent::get($context);
    }
    public function post(array $context) {

       $id = $this->params['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $sql = <<<EOL
        UPDATE mutants_objects SET title= :title, description= :description, type= :type, info= :info WHERE id= :id
        EOL;


        $query = $this->pdo->prepare($sql);

        $query->bindValue(":id", $id);
        $query->bindValue(":title", $title);
        $query->bindValue(":description", $description);
        $query->bindValue(":type", $type);
        $query->bindValue(":info", $info);

        $query->execute();
        $context['message'] = 'Объект успешно обновлён';
        $this->get($context);

    }
    
}