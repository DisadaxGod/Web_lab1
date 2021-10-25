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
        
    }elseif (preg_match("#^/wolverine#", $url)) {
        $title = "Росомаха";
        $template = "__object.twig";
        $context['image'] = "/images/wolf.jpg";
        if (preg_match("#^/wolverine/image#", $url)){
            $template = "image.twig";
        } elseif(preg_match("#^/wolverine/info#", $url)){
            $template = "wolf_info.twig";
        }
        
    }elseif (preg_match("#^/quicksilver#", $url)) {
        $title = "Ртуть";
        $template = "__object.twig";
        $context['image'] = "/images/silver.jpg";
        if (preg_match("#^/quicksilver/image#", $url)){
            $template = "image.twig";
        } elseif(preg_match("#^/quicksilver/info#", $url)){
            $template = "silver_info.twig";
        }
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