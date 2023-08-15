<?php
class DashboardUpdateLogementController extends Controller
{
    public function DashboardUpdateLogement()
    {
        $dashboard = $this->dashboard();
        if (isset($_POST['validerTitle'])) {
            $title = ($_POST['title']);

            $return = $modelUpdate->setTitle($title, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $dashboard->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }
    }
}
