<?php
session_start();


require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/Projet/homeaway1.0');



$router->map('GET', '/', 'LogementController#homepage', 'home' );
$router->map('GET', '/legalNotices', 'LogementController#legalNotices', 'legalNotices' );
$router->map('GET', '/', 'LogementController#getAllLogements', 'getAll' );


// **-------ROUTE UTILISATEUR-------
$router->map('GET|POST', '/login', 'PersonController#userLogin', 'login');
$router->map('GET', '/logout', 'PersonController#logout', 'logout');
$router->map('GET|POST', '/register', 'PersonController#createPerson', 'register');
$router->map('GET', '/dashboard', 'DashboardController#dashboard', 'dashboard');

// **-------ROUTE RECHERCHE-------**
$router->map('GET|POST', '/search', 'SearchController#searchLogement', 'search');

// **------ROUTE LOGEMENT ------**

$router->map('GET|POST', '/add', 'LogementController#addLogement', 'add');
$router->map('GET', '/one', 'LogementController#getOneLogement', 'one');

// $router->map('GET','/AllLogement/[a:city]', 'LogementController#getAllLogement', 'AllLogement');
// $router->map('GET', '/logement/[a:city]', 'LogementController#getAllLogement', 'logement');

$router->map('GET', '/logement/[a:city]', 'LogementController#getAllLogement', 'logement');
// $router->map('GET', '/logement/[i:id]', 'LogementController#getLogementDetails', 'logement');





$match = $router->match();




//var_dump($match);

// var_dump($_SESSION);
if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);

    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}
