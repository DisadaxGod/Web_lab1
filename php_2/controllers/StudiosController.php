<?php
require_once "BaseMutantsTwigController.php";

class StudiosController extends BaseMutantsTwigController {
    public $template = "studios.twig"; // указываем шаблон

    
    public function getContext(): array
    {
        $context = parent::getContext();
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        $query = $this->pdo->prepare("SELECT * FROM studios");
        
        // стягиваем одну строчку из базы
        
        $query->execute();
        $data = $query->fetchAll();
        
        // передаем описание из БД в контекст
        
        $context['studios'] = $data;


        return $context;
    }
}