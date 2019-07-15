<?php

include $_SERVER["DOCUMENT_ROOT"] . "/src/Include/commonInclude.php";

use App\Router\Router;

// if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) {
//     var_dump($_SESSION["user_login"]);
//     var_dump($_SESSION["user_id"]);
// }

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
        // Disconnect
            $router->get('/logout', 'Authentication#logout');

    // POST Method Routes :
        $router->post('/connection', 'Authentication#checkLogin');

$router->run();
