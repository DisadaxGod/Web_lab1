<?php
require_once "BaseMutantsTwigController.php";

class ObjectController extends BaseMutantsTwigController {
    public $template = "__object.twig"; // указываем шаблон

    public function getTemplate(){
        if(isset($_GET['view'])){
           
            if($_GET['view']=='image'){
           return "image.twig";
            
            }
            elseif ($_GET['view']=='info') {
           return "base_info.twig";

            }
        }
        return parent::getTemplate();
    }

    public function getContext(): array
    {
        $context = parent::getContext();
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        $query = $this->pdo->prepare("SELECT description, title, image, info,  id FROM mutants_objects WHERE id= :my_id");
        
        // стягиваем одну строчку из базы
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        // передаем описание из БД в контекст
        
        $context['id'] = $data['id'];
        $context['title'] = $data['title'];


        if(isset($_GET['view'])){
            if($_GET['view']=='image'){

                $context['type'] = "image";
                $context['image'] = $data['image'];
                }
                elseif ($_GET['view']=='info') {
                $context['type'] = "text";
                $context['info'] = $data['info'];
                }
        }else {
            // $query = $this->pdo->query("SELECT * FROM mutants_objects");
            $context['description'] = $data['description']; 
        }

        // if(isset($_GET['type'])){
        //     $context = parent::getContext();
        //     $query = $this->pdo->prepare("SELECT image,  type FROM mutants_objects WHERE type= :type");
        //     $query->bindValue("type", $this->params['type']);
        //     $query->execute();
        //     $data = $query->fetch();
        //     $context['image'] = $data['image'];
        //     // $context['type'] = "image";
        // }else {
        //     $query = $this->pdo->query("SELECT * FROM mutants_objects");
        // }


        return $context;
    }
}