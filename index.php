<?php
require 'vendor/autoload.php';

use App\router\Router;

$page = 'home';
if  (isset($_GET['p'])) {
    $page = $_GET['p'];
}
if (isset($_POST['p'])) {
    $page = $_POST['p'];
}
// foreach ($_SERVER as $label => $info) {
//    echo "<p><b>" . $label . "</b> : " . var_dump($info) . "</p>"; 
// }
echo($_POST["login"] . "<br/>") ?? "Guest<br/>";

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


