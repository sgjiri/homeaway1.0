<?php
class DashboardController extends Controller
{
    public function dashboard()
    {
        $twig = $this->getTwig();
        $idUser = $_SESSION['id_person'];
        $model = new DashboardModel();
        if (!$_POST) {
            $datas = $model->getUser($idUser);
            echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
        }
        if (isset($_POST['validerName'])) {
            $firstname = ($_POST['firstname']);
            $lastname = ($_POST['lastname']);
            $return = $model->setName($lastname, $firstname, $idUser);

            if($return){
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerMail'])) {
            $mail = ($_POST['mail']);
            $return = $model->setMail($mail, $idUser);

            if($return){
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerDateOfBird'])) {
            $dateOfBird = ($_POST['date_of_birth']);
            $return = $model->setDateOfBird($dateOfBird, $idUser);

            if($return){
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }
        if (isset($_POST['validerTel'])) {
            $tel = ($_POST['tel']);
            $return = $model->setTel($tel, $idUser);

            if($return){
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerPassword'])) {
            $password = ($_POST['password']);
            $passwordConfirme = ($_POST['passwordConfirm']);
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $return = $model->setPassword($password, $passwordConfirme, $idUser, $passwordHashed);
            $datas = $model->getUser($idUser);

            if($return){
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]), "<script>alert(\"changement de mot de passe ruisi\")</script>";
            }else{
                echo "<script>alert(\"les donné saisi ne sont pas les meme\")</script>";
            }
        }
    }
}
