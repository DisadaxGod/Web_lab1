<?php
require_once "BaseMutantsTwigController.php";

class ControllerLogOut extends BaseMutantsTwigController {

    public function get(array $context){
        $_SESSION["is_logged"] = false;
        header('Location: /login');
        exit; 
    }
}