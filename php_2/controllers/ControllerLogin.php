<?php
require_once "BaseMutantsTwigController.php";

class ControllerLogin extends BaseMutantsTwigController {
    public $template = "login.twig";
    public $title = "Login";

    public function post(array $context)
    {
        $user = $_POST['login'];
        $password = $_POST['password'];        
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindValue("username", $user);
        $query->bindValue("password", $password);
        $query->execute(); 
        $data = $query->fetch();
        print_r($data);
        if ($data) {
            $_SESSION["is_logged"] = true;
            header('Location: /');
        } 
        $context['message'] = 'Неверные данные';
        $this->get($context);
    }
}