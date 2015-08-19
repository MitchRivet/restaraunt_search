<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaraunt.php";
    require_once __DIR__."/../src/Cuisine.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=restaraunt_search';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/restaraunts", function() use ($app) {
        return $app['twig']->render('restaraunts.html.twig', array('restaraunts' => Restaraunt::getAll()));
    });

    $app->get("/cuisines", function() use ($app) {
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaraunts' => $cuisine->getRestaraunts()));
    });

    $app->post("/restaraunts", function() use ($app) {
        $restaraunt_name = $_POST['RestarauntName'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaraunt = new Restaraunt($restaraunt_name, $id = null, $cuisine_id);
        $restaraunt->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaraunts' => $cuisine->getRestaraunts()));
    });

    $app->post("/delete_restaraunts", function() use ($app) {
        Restaraunt::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine($_POST['CuisineName']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
