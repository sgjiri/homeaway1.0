<?php
class LogementController extends Controller {
    public function homepage() {
        $twig = $this-> getTwig();
        echo $twig->render('homePage.html.twig',[]);
    }

}
