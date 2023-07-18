<?php
session_start();

require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/Projet/homeaway1.0');


// **-------ROUTE HOMEPAGE-------**//
$router->map('GET', '/', 'HomePageController#homepage', 'home' );
// $router->map('GET', '/', 'HomePageController#cityBeach', 'home' );
$router->map('GET', '/logement/', '', 'baseLogement');
$router->map('GET', '/logement/[i:id_ville]', 'HomePageController#cityBeach', 'city');


// **-------ROUTE UTILISATEUR-------//
$router->map('GET|POST', '/login', 'PersonController#userLogin', 'login');
$router->map('GET', '/logout', 'PersonController#logout', 'logout');
$router->map('GET|POST', '/register', 'PersonController#createPerson', 'register');
$router->map('GET', '/dashboard', 'DashboardController#dashboard', 'dashboard');


// **-------ROUTE RECHERCHE-------**//
$router->map('GET|POST', '/search', 'SearchController#searchLogement', 'search');


// **------ROUTE LOGEMENT ------**//

$router->map('GET|POST', '/add', 'LogementController#addLogement', 'add');
$router->map('GET', '/one', 'LogementController#getOneLogement', 'one');
$router->map('GET','/all/','LogementController#getAllLogement','logements');
$router->map('GET|POST','/upload','LogementController#getUploadImg','upload_img');



// **------ROUTE FOOTER------**//
$router->map('GET', '/legalNotices', 'HomePageController#legalNotices', 'legalNotices' );


$match = $router->match();

// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);

    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}