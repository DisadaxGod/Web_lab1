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
        $context['name'] = "wolverine";
        if (preg_match("#^/wolverine/image#", $url)){
            $template = "image.twig";
            $context['image'] = "/images/wolf.jpg";
            $context['type'] = "image";
        } elseif(preg_match("#^/wolverine/info#", $url)){
            $template = "wolf_info.twig";
            $context['text'] = "/images/wolf_info.php";
            $context['type'] = "text";
        }
        
    }elseif (preg_match("#^/quicksilver#", $url)) {
        $title = "Ртуть";
        $template = "__object.twig";
        $context['name'] = "quicksilver";
        if (preg_match("#^/quicksilver/image#", $url)){
            $template = "image.twig";
            $context['image'] = "/images/silver.jpg";
            $context['type'] = "image";
        } elseif(preg_match("#^/quicksilver/info#", $url)){
            $template = "silver_info.twig";
            $context['text'] = "/images/silver_info.php";
            $context['type'] = "text";
        }
    }
    
    $menu = [ 
        [
            "title" => "Росомаха",
            "url-main" => "/wolverine",
            "url-image" => "/wolverine/image",
            "url-info" => "/wolverine/info",
        ],
        [
            "title" => "Ртуть",
            "url-main" => "/quicksilver",
            "url-image" => "/quicksilver/image",
            "url-info" => "/quicksilver/info",
        ]
    ];   

    $context['title'] = $title;
    $context['menu'] = $menu;
    echo $twig->render($template, $context);






?>