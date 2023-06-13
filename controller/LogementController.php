<?php
class LogementController extends Controller {
    public function homepage() {
        $twig = $this-> getTwig();
        echo $twig->render('homePage.html.twig',[]);
    }
    public function legalNotices() {
        $twig = $this-> getTwig();
        echo $twig->render('legalNotices.html.twig',[]);
    }

}
