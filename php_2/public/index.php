<?php
    require_once '../vendor/autoload.php';
    require_once "../framework/autoload.php";
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";
    require_once "../controllers/Controller404.php";
    
    
    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader, [
        "debug" => true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    // $url = $_SERVER["REQUEST_URI"];



    $title = "";
    $template = "";
    $context = [];

    // $controller = new Controller404($twig);

    $pdo = new PDO("mysql:host=localhost;dbname=mutants;charset=utf8", "root", "");
    
    // $query = $pdo->query("SELECT DISTINCT type FROM mutants_objects ORDER BY 1");
    // $types = $query->fetchAll();
    // $twig->addGlobal("types", $types);



    $router = new Router($twig, $pdo);
    $router->add("/", MainController::class);
    $router->add("/mutants-object/(?P<id>\d+)", ObjectController::class);
    // $router->add("/mutants-object/(?P<id>\d+)/info", InfoController::class);
    // $router->add("/mutants-object/(?P<id>\d+)/image", ImageController::class);
    


    $router->get_or_default(Controller404::class);


    // if ($url == "/") {
    //     //$title = "Главная";
    //     //$template = "main.twig";
    //     $controller = new MainController($twig);
        
    //  }
     //elseif (preg_match("#^/wolverine#", $url)) {
        
    //     $controller = new WolverineController($twig);
        
    //     if (preg_match("#^/wolverine/image#", $url)){
    //         //$template = "image.twig";
    //         //$context['image'] = "/images/wolf.jpg";
    //         //$context['type'] = "image";
    //         $controller = new WolverineImageController($twig);
    //     } elseif(preg_match("#^/wolverine/info#", $url)){
    //         //$template = "wolf_info.twig";
    //         //$context['text'] = "/images/wolf_info.php";
    //         //$context['type'] = "text";
    //         $controller = new WolverineInfoController($twig);
    //     }
        
    // }elseif (preg_match("#^/quicksilver#", $url)) {
    //     $controller = new SilverController($twig);
    //     // $title = "Ртуть";
    //     // $template = "__object.twig";
    //     // $context['name'] = "quicksilver";
    //     if (preg_match("#^/quicksilver/image#", $url)){
    //         // $template = "image.twig";
    //         // $context['image'] = "/images/silver.jpg";
    //         // $context['type'] = "image";
    //         $controller = new SilverImageController($twig);
    //     } elseif(preg_match("#^/quicksilver/info#", $url)){
    //         // $template = "silver_info.twig";
    //         // $context['text'] = "/images/silver_info.php";
    //         // $context['type'] = "text";
    //         $controller = new SilverInfoController($twig);
    //     }
    // }

    
    // $menu = [ 
    //     [
    //         "title" => "Росомаха",
    //         "url-main" => "/wolverine",
    //         "url-image" => "/wolverine/image",
    //         "url-info" => "/wolverine/info",
    //     ],
    //     [
    //         "title" => "Ртуть",
    //         "url-main" => "/quicksilver",
    //         "url-image" => "/quicksilver/image",
    //         "url-info" => "/quicksilver/info",
    //     ]
    // ];   

    
    // $context['menu'] = $menu;

    // if ($controller) {
    //     $controller->setPDO($pdo);
    //     $controller->get();
    // }
