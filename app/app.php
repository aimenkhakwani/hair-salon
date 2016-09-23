
<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();
    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/addStylist", function() use ($app) {
        $id = null;
        $name = $_POST['name'];
        $stylist = new Stylist($id, $name);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/deleteStylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/getStylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/addClient", function() use ($app) {
        $id = null;
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($id, $name, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/deleteClients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->patch("/updateStylist/{id}", function ($id) use ($app){
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->delete("/deleteStylist/{id}", function($id) use ($app){
       $stylist = Stylist::find($id);
       $stylist->delete();
       return $app['twig']->render('index.html.twig',  array('stylists' => Stylist::getAll()));
   });

   $app->get("/getClient/{id}", function($id) use ($app) {
       $client = Client::find($id);
       $stylist = Stylist::find($client->getStylistId());
       return $app['twig']->render('client.html.twig', array('client' => $client, 'stylist' => $stylist));
   });

   $app->delete("/deleteClient/{id}", function($id) use ($app){
      $client = Client::find($id);
      $stylist = Stylist::find($client->getStylistId());
      $client->delete();
      return $app['twig']->render('stylist.html.twig',  array('stylist' => $stylist, 'clients' => $stylist->getClients()));
  });

    return $app;
 ?>
