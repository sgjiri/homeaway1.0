<?php
class DashboardController extends Controller
{
    public function dashboard()
    {
        $twig = $this->getTwig();
        $idUser = $_SESSION['id_person'];
        $model = new DashboardModel();
        $modelUpdate = new DashboardUpdateLogementModel();
       
        if (!$_POST) {
            $datas = $model->getUser($idUser);
            $datasLogement = $modelUpdate->getLogement($idUser);
            echo $twig->render('templateDashboard.html.twig', ['user' => $datas, 'logement' => $datasLogement ]);
        }
        if (isset($_POST['validerName'])) {
            $firstname = ($_POST['firstname']);
            $lastname = ($_POST['lastname']);
            $return = $model->setName($lastname, $firstname, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerMail'])) {
            $mail = ($_POST['mail']);
            $return = $model->setMail($mail, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerDateOfBird'])) {
            $dateOfBird = ($_POST['date_of_birth']);
            $return = $model->setDateOfBird($dateOfBird, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }
        if (isset($_POST['validerTel'])) {
            $tel = ($_POST['tel']);
            $return = $model->setTel($tel, $idUser);

            if ($return) {
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

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]), "<script>alert(\"changement de mot de passe ruisi\")</script>";
            } else {
                echo "<script>alert(\"les donné saisi ne sont pas les meme\")</script>";
            }
        }
       

        if (isset($_POST['validerTitle'])) {
            $title = ($_POST['title']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setTitle($title, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerAdresse'])) {
            $adresseSaisis = ($_POST['adresse']);
            $idLogement = ($_POST['idLogement']);
            $tableauAdresse = explode(", ",$adresseSaisis);
            $adresse = $tableauAdresse[0];
            $codePostale = $tableauAdresse[1];
            $city = $tableauAdresse[2];
            
            $return = $modelUpdate->setAdresse($adresse, $codePostale, $city, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerType'])) {
            $type = ($_POST['type']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setType($type, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerSurface'])) {
            $surface = ($_POST['surface']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setSurface($surface, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerLocation'])) {
            $location = ($_POST['location']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setLocation($location, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerPrice'])) {
            $price_by_night = ($_POST['price_by_night']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setPrice($price_by_night, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerPersone'])) {
            $number_of_person = ($_POST['number_of_person']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setPersone($number_of_person, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

    }
}
