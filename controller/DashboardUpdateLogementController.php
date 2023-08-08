<?php
class DashboardUpdateLogementController extends Controller
{
    public function DashboardUpdateLogement()
    {
        $twig = $this->getTwig();
        $idUser = $_SESSION['id_person'];
        var_dump($idUser);
        $model = new DashboardUpdateLogementModel();
        if (!$_POST) {
            $datas = $model->getLogement($idUser);
            echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
        }
        // if (isset($_POST['validerTitle'])) {
        //     $title = ($_POST['title']);
        //     $return = $model->setName($title, $idUser);

        //     if($return){
        //         $datas = $model->getUser($idUser);
        //         echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
        //     }
        // }
        
    }
}
