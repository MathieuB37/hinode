<?php
require 'vendor/autoload.php';

use App\router\Router;

$page = 'home';
if  (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Routing :
$router = new Router($_GET['url']);

$router->get('/', function(){ echo 'HomePage'; });
$router->get('/article', function(){ echo 'Tous les articles'; });
$router->get('/article/:slug-:id', function($slug, $id) use ($router){ 
    echo $router->url('article.show', ['id' => 1, 'slug' => 'Salut-les-gens']); 
}, 'article.show')->with('id', '[0-9+]')->with('slug', '[a-z\-0-9]+');
$router->get('/article/:id', 'Article#show');
$router->post('/article/:id', function($id){ echo 'Poster pour l\'article' . $id; });
$router->run();


// Template Render :
$loader = new Twig_Loader_Filesystem(__DIR__ . '/src/view/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, __DIR__ . '/tmp',
]);

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'connection':
        echo $twig->render('connection.twig');
        break;
    default:
        echo $twig->render('404.twig');
        break;
}


