<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Item.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

  //loads actual twig file
    $app->get("/", function() use ($app) {
      $items = array();
      return $app['twig']->render("home.html.twig", array('items' => $items));
    });

  //loads basic php
    $app->post("/inventory", function() use ($app) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $item = new Item($name, $description, $quantity);
        $item->save();

        return $app['twig']->render("home.html.twig", array('items' => Item::getAll()));
    });

    $app->post("/delete", function () use ($app) {
        $items = array();
        Item::deleteAll();
        return $app['twig']->render("home.html.twig", array('items' => $items));
    });

    return $app;
?>
