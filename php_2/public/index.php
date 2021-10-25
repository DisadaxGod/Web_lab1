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
        
    }elseif (preg_match("#/mermaid#", $url)) {
        $title = "Русалка";
        $template = "base_image.twig";
        $context['image'] = "/images/085_mermaid.jpg";
        
    }elseif (preg_match("#/uranus#", $url)) {
        $title = "Уран";
        $template = "base_image.twig";
        $context['image'] = "/images/086_uranus.png";
    }
    $menu = [ 
        [
            "title" => "Главная",
            "url" => "/",
        ],
        [
            "title" => "Русалка",
            "url" => "/mermaid",
        ],
        [
            "title" => "Уран",
            "url" => "/uranus",
        ]
    ];
    

    $context['title'] = $title;
    $context['menu'] = $menu;
    echo $twig->render($template, $context);
?>