<?php
    require_once '../vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader);
    $url = $_SERVER["REQUEST_URI"];

    $title = "";
    $template = "";
    $context = [];


    if ($url == "/") {
        $title = "Главная";
        $template = "main.twig";
        
    }elseif (preg_match("#/wolverine#", $url)) {
        $title = "Росомаха";
        $template = "base_image.twig";
        $context['image'] = "/images/wolf.jpg";
        
    }elseif (preg_match("#/quicksilver#", $url)) {
        $title = "Ртуть";
        $template = "base_image.twig";
        $context['image'] = "/images/silver.jpg";
    }
    $menu = [ 
        [
            "title" => "Главная",
            "url" => "/",
        ],
        [
            "title" => "Росомаха",
            "url" => "/wolverine",
        ],
        [
            "title" => "Ртуть",
            "url" => "/quicksilver",
        ]
    ];
    

    $context['title'] = $title;
    $context['menu'] = $menu;
    echo $twig->render($template, $context);






?>