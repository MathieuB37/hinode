<?php

include $_SERVER["DOCUMENT_ROOT"] . "/src/Include/commonInclude.php";

use App\Router\Router;
use App\Service\LanguageService;

// if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) {
//     var_dump($_SESSION["user_login"]);
//     var_dump($_SESSION["user_id"]);
// }

// Setting a default language for the user based on the user-agent (if not already set)
if (!isset($_SESSION["lang"])) {
    $UserAgentLang = strtoupper(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2));
    $langService = new LanguageService;
    $langService->setSessionLang($UserAgentLang);
}

$page = 'home';
if (isset($_GET['p'])) {
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
$router->get('/article', function () {echo 'Tous les articles';});
$router->get('/article/create', 'Article#create');
// $router->get('/article/:slug-:id', function($slug, $id) use ($router){
//     echo $router->url('article.show', ['id' => 1, 'slug' => 'Salut-les-gens']);
// }, 'article.show')->with('id', '[0-9+]')->with('slug', '[a-z\-0-9]+');
$router->get('/article/:id', 'Article#show');
// Authentication
$router->get('/connection', 'Authentication#checkLogin');
$router->get('/register', 'Authentication#checkRegister');
$router->post('/register', 'Authentication#checkRegister');
// Disconnect
$router->get('/logout', 'Authentication#logout');
// Language
$router->get('/languageList', 'Language#getLangList');
$router->get('/language/set/:lang', 'Language#setSessionLang');

// POST Method Routes :
$router->post('/connection', 'Authentication#checkLogin');

// Default 404 :
$router->get('/404', 'Home#redirect404');

$router->run();
