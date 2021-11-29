<?php
require_once "BaseMutantsTwigController.php";

class StudiosCreateController extends BaseMutantsTwigController {
    public $template = "studios_create.twig";


    public function get(array $context)
    {
        echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context);
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $title = $_POST['title'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");

        $image_url = "/media/$name";

        // создаем текст запрос
        $sql = <<<EOL
            INSERT INTO studios(title, image)
            VALUES(:title, :image_url)
        EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("image_url", $image_url);

        
        
        // выполняем запрос
        $query->execute();


        $context['message'] = 'Вы успешно создали студию';
        $context['id'] = $this->pdo->lastInsertId();
        $this->get($context); // вызываю get
    }

    
}