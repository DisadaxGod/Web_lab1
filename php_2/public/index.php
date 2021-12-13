<?php
    require_once '../vendor/autoload.php';
    require_once "../framework/autoload.php";
    require_once "../framework/BaseMiddleware.php";
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";
    require_once "../controllers/SearchController.php";
    require_once "../controllers/MutantObjectCreateController.php";
    require_once "../controllers/MutantObjectDeleteController.php";
    require_once "../controllers/MutantObjectUpdateController.php";
    require_once "../controllers/StudiosCreateController.php";
    require_once "../controllers/StudiosController.php";
    require_once "../framework/Rest.php";
    require_once "../middlewares/LoginRequiredMiddeware.php";
    require_once "../controllers/SetWelcomeController.php";
    require_once "../middlewares/LoginRequiredMiddeware.php";
    require_once "../middlewares/HistoryMiddleware.php";
    require_once "../controllers/ControllerLogin.php";
    require_once "../controllers/ControllerLogOut.php";
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
    $router->add("/", MainController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("", BaseMiddleware::class);
    $router->add("/mutants-object/(?P<id>\d+)", ObjectController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/search", SearchController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/mutants-object/create", MutantObjectCreateController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/studios/create", StudiosCreateController::class) 
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/studios", StudiosController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/mutants-object/(?P<id>\d+)/delete", MutantObjectDeleteController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/mutants-object/(?P<id>\d+)/edit", MutantObjectUpdateController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/api/mutants-object", Rest::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/api/mutants-object/(?P<id>\d+)", Rest::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/set-welcome/", SetWelcomeController::class)
    ->middleware(new LoginRequiredMiddeware())->middleware(new HistoryMiddleware());
    $router->add("/login", ControllerLogin::class);
    $router->add("/logout", ControllerLogOut::class);
    


    
    $router->get_or_default(Controller404::class);
