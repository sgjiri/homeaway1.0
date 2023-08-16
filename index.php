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
$router->map('GET|POST', '/dashboard', 'DashboardController#dashboard', 'dashboard');



// **-------ROUTE RECHERCHE-------**//
$router->map('GET|POST', '/search', 'SearchController#searchLogement', 'search');

$router->map('POST','/filter/','SearchController#applyFilter','searchWithFilters');

$router->map('GET|POST', '/one[i:id_logement]?', 'LogementController#getOneLogement', 'one');

$router->map('GET','/beach/[:city]?', 'SearchController#searchByCity','beach');
$router->map('GET','/type/[a:type]?', 'SearchController#searchByType','type');



// **------ROUTE LOGEMENT ------**//


$router->map('GET|POST', '/add', 'DashboardController#addLogement', 'add');
$router->map('GET|POST', '/deleteLogement', 'LogementController#deleteLogement', 'deleteLogement');
$router->map('GET','/all/','LogementController#getAllLogement','logements');
$router->map('GET|POST','/upload','LogementController#getUploadImg','upload_img');

// -*-*-*RESERVATION*-*-*-
$router->map('POST','/reservation','BookController#getReservation','reservation');


// -*-*-*Contact formulaire*-*-*-
$router->map('POST|GET','/formContact','LogementController#sendMail','formContact');


// **------ROUTE FOOTER------**//
$router->map('GET', '/legalNotices', 'HomePageController#legalNotices', 'legalNotices' );


// -*-*-*ROUTE FAQ*-*-*-
$router->map('GET', '/faq', 'HomePageController#faq', 'faq' );

// *-*-*-*ROUTE CONTACTER L HOTE*-*-*-*
$router->map('GET|POST', '/contact', 'LogementController#contactMe', 'contact' );


// *-*-*-*ROUTE ENVOI MAIL CONTACTER L HOTE*-*-*-*
$router->map('POST', '/sendMail', 'ContactController#sendMail', 'sendMail' );


$match = $router->match();
// var_dump($_SESSION);
//  var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);

    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
} else {
        $errorController = new ErrorController();
        $errorController->error404();
    }