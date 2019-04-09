<?php
require 'vendor/autoload.php';

use App\Router;
new Router('blah.html');
die;
// Routing :
$page = 'home';
if  (isset($_GET['p'])) {
    $page = $_GET['p'];
}

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




// Routing (TODO: FAIRE LE ROUTING):

// die($_GET['url']);

$router = new Router($_GET['url']);

$router->get('/posts', function(){ echo 'Tous les articles'; });
$router->get('/posts/:id', function($id){ echo 'Afficher l\'article' . $id; });

$router->run();

