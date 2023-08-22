<?php



class ErrorController extends Controller
{
    
    public function error404()
    {
        // Créer une instance du moteur de rendu Twig
        $twig = $this->getTwig();

        // Charger et afficher la vue 404.html.twig
        echo $twig->render('404.html.twig',[]);
    }
}