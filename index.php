<?php
require 'vendor/autoload.php';

use App\Router\Router;

// session_start();
// isset($_SESSION["language"]) ?? $_SESSION["language"] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
// if (session_start()) {
//     $_SESSION["language"] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
// }
// var_dump($_SESSION);
// echo($_SESSION["login"] . "<br/>") ?? "Guest<br/>";

$page = 'home';
if  (isset($_GET['p'])) {
    $page = $_GET['p'];
}
if (isset($_POST['p'])) {
    $page = $_POST['p'];
}

//// Routing :
    $router = new Router($_GET['url']);
    // GET Method Routes :
        // Home
            $router->get('/', 'Home#display');
            $router->get('/home', 'Home#display');
        // Article
            $router->get('/article', function(){ echo 'Tous les articles'; });
            $router->get('/article/create', 'Article#create');
            // $router->get('/article/:slug-:id', function($slug, $id) use ($router){ 
            //     echo $router->url('article.show', ['id' => 1, 'slug' => 'Salut-les-gens']); 
            // }, 'article.show')->with('id', '[0-9+]')->with('slug', '[a-z\-0-9]+');
            $router->get('/article/:id', 'Article#show');
        // Authentication
            $router->get('/connection', 'Authentication#checkLogin');

    // POST Method Routes :
        $router->post('/connection', 'Authentication#checkLogin');

$router->run();
