<?php
class DashboardController extends Controller{
    public function dashboard(){
        $twig = $this-> getTwig();
        $idUser = $_SESSION['id_person'];
        $model = new DashboardModel();
        $datas = $model ->getUser($idUser);
        var_dump($datas);

        echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
    }
    
}