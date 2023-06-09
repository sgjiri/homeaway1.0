<?php
class DashboardController extends Controller{
    public function dashboard(){
        $twig = $this-> getTwig();
        echo $twig->render('templateDashboard.html.twig',[]);
    }
    
}