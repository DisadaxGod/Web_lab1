<?php

require_once "BaseMutantsTwigController.php";

class ImageController extends BaseMutantsTwigController {
    public $template = "image.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        $query = $this->pdo->prepare("SELECT image,  id FROM mutants_objects WHERE id= :my_id");
        
        
        // стягиваем одну строчку из базы
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
        
        // передаем описание из БД в контекст
        $context['image'] = $data['image'];
        $context['type'] = "image";
        
        

        return $context;
    }
}