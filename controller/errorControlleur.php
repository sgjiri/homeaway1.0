<?php



class ErrorController extends Controller
{
    
    public function error404()
    {
        // Créer une instance du moteur de rendu Twig
        $loader = new \Twig\Loader\FilesystemLoader('./view');
        $twig = new \Twig\Environment($loader);

        // Charger et afficher la vue 404.html.twig
        echo $twig->render('404.html.twig');
    }
}