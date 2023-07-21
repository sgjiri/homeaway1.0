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
$router->map('GET|POST', '/one[i:id_logement]?', 'LogementController#getOneLogement', 'one');



// **------ROUTE LOGEMENT ------**//


$router->map('GET|POST', '/add', 'LogementController#addLogement', 'add');

<<<<<<< HEAD
// $router->map('GET|POST', '/one', 'LogementController#getOneLogement', 'one');
=======
$router->map('GET', '/one/[i:id_logement]?', 'LogementController#getOneLogement', 'one');

>>>>>>> 30262acd445b418eaa30611adb0b950a82a3fe12
$router->map('GET','/all/','LogementController#getAllLogement','logements');
$router->map('GET|POST','/upload','LogementController#getUploadImg','upload_img');



// **------ROUTE FOOTER------**//
$router->map('GET', '/legalNotices', 'HomePageController#legalNotices', 'legalNotices' );


$match = $router->match();

//  var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);

    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}