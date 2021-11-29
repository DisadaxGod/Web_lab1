<?php
    require_once '../vendor/autoload.php';
    require_once "../framework/autoload.php";
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";
    require_once "../controllers/SearchController.php";
    require_once "../controllers/MutantObjectCreateController.php";
    require_once "../controllers/MutantObjectDeleteController.php";
    require_once "../controllers/StudiosCreateController.php";
    require_once "../controllers/StudiosController.php";
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
    $router->add("/search", SearchController::class);
    $router->add("/mutants-object/create", MutantObjectCreateController::class);
    $router->add("/studios/create", StudiosCreateController::class);
    $router->add("/studios", StudiosController::class);
    $router->add("/mutants-object/(?P<id>\d+)/delete", MutantObjectDeleteController::class);
  
    


    $router->get_or_default(Controller404::class);
