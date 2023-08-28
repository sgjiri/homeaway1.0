<?php
class DashboardController extends Controller
{
    public function dashboard()
    {
        $twig = $this->getTwig();
        $idUser = $_SESSION['id_person'];
        $model = new DashboardModel();
        $modelUpdate = new DashboardUpdateLogementModel();
        $modelReservation = new DashboardReservationModel();
        $modelLikes = new DashboardLikesModel();
        $date = date('Y-m-d');
        if (!$_POST) {
            $datas = $model->getUser($idUser);
            
            $datasLogement = $modelUpdate->getLogement($idUser);
            $datasMesReservation = $modelReservation->getReservation($idUser, $date);
            $datasHistoriqueReservation = $modelReservation->getHistoriqueReservation($idUser, $date);
            $datasReservationChezMoi = $modelReservation->getReservationChezMoi($idUser, $date);
            $datasHistoriqueReservationChezMoi = $modelReservation->getHistoriqueReservationChezMoi($idUser, $date);
            
            for ($i = 0; $i < count($datasMesReservation); $i++) {
                
                
                $dtStart = strtotime($datasMesReservation[$i]['start_date']);
                $dtEnd = strtotime($datasMesReservation[$i]['end_date']);
                $dateStartRservation = date("d/m/Y", $dtStart);
                $dateEndRservation = date("d/m/Y", $dtEnd);
                $datasMesReservation[$i]['start_date'] = $dateStartRservation;
                $datasMesReservation[$i]['end_date'] = $dateEndRservation;


            }

            for ($i = 0; $i < count($datasHistoriqueReservation); $i++) {
                
                
                $dtStart = strtotime($datasHistoriqueReservation[$i]['start_date']);
                $dtEnd = strtotime($datasHistoriqueReservation[$i]['end_date']);
                $dateStartRservation = date("d/m/Y", $dtStart);
                $dateEndRservation = date("d/m/Y", $dtEnd);
                $datasHistoriqueReservation[$i]['start_date'] = $dateStartRservation;
                $datasHistoriqueReservation[$i]['end_date'] = $dateEndRservation;


            }


            $datasLikes= $modelLikes->getLikes($idUser);
            $imageArray = [];
            for ($i = 0; $i < count($datasLogement); $i++) {
                $images = $datasLogement[$i]['images'];
                $arrayImage = explode(',', $images);

                $imageArray[] = $arrayImage;
            }
            $arrayContacts = [];
            $arrayStart_date = [];
            $arrayEnd_dateArray = [];
            $arrayName = [];
            $arrayFirstname = [];
            for ($i = 0; $i < count($datasReservationChezMoi); $i++) {

                // var_dump($datasReservationChezMoi[$i]['start_date']);

                // $dtStart = strtotime($datasReservationChezMoi[$i]['start_date']);
                // $dtEnd = strtotime($datasReservationChezMoi[$i]['end_date']);
                // $dateStartRservation = date("d/m/Y", $dtStart);
                // $dateEndRservation = date("d/m/Y", $dtEnd);
                // $datasReservationChezMoi[$i]['start_date'] = $dateStartRservation;

                $datasReservationChezMoi[$i]['end_date'] = $dateEndRservation;
                $contact = $datasReservationChezMoi[$i]['contact'];
                $start_date = $datasReservationChezMoi[$i]['start_date'];
                $end_date = $datasReservationChezMoi[$i]['end_date'];
                $name = $datasReservationChezMoi[$i]['name'];
                $firstname = $datasReservationChezMoi[$i]['firstname'];

                


                $contactArray = explode(',', $contact);
                $start_dateArray = explode(',', $start_date);
                $end_dateArray = explode(',', $end_date);
                $nameArray = explode(',', $name);
                $firstnameArray = explode(',', $firstname);

                $arrayContacts[] = $contactArray;
                $arrayStart_date[] = $start_dateArray;
                $arrayEnd_dateArray[] = $end_dateArray;
                $arrayName[] = $nameArray;
                $arrayFirstname[] = $firstnameArray;
            }


            $arrayHistoriqueContacts = [];
            $arrayHistoriqueStart_date = [];
            $arrayHistoriqueEnd_dateArray = [];
            $arrayHistoriqueName = [];
            $arrayHistoriqueFirstname = [];
            for ($i = 0; $i < count($datasHistoriqueReservationChezMoi); $i++) {
                $historiquecontact = $datasHistoriqueReservationChezMoi[$i]['contact'];
                $historiquestart_date = $datasHistoriqueReservationChezMoi[$i]['start_date'];
                $historiqueend_date = $datasHistoriqueReservationChezMoi[$i]['end_date'];
                $historiquename = $datasHistoriqueReservationChezMoi[$i]['name'];
                $historiquefirstname = $datasHistoriqueReservationChezMoi[$i]['firstname'];
                $historiquecontactArray = explode(',', $historiquecontact);
                $historiquestart_dateArray = explode(',', $historiquestart_date);
                $historiqueend_dateArray = explode(',', $historiqueend_date);
                $historiquenameArray = explode(',', $historiquename);
                $historiquefirstnameArray = explode(',', $historiquefirstname);

                $arrayHistoriqueContacts[] = $historiquecontactArray;
                $arrayHistoriqueStart_date[] = $historiquestart_dateArray;
                $arrayHistoriqueEnd_dateArray[] = $historiqueend_dateArray;
                $arrayHistoriqueName[] = $historiquenameArray;
                $arrayHistoriqueFirstname[] = $historiquefirstnameArray;
            }


            echo $twig->render('templateDashboard.html.twig', ['user' => $datas, 'logement' => $datasLogement, 'images' => $imageArray, 'mesReservations' => $datasMesReservation, 'historiqueReservation' => $datasHistoriqueReservation,'datasReservationChezMoi' => $datasReservationChezMoi, 'contacts' => $arrayContacts, 'start_dates' => $arrayStart_date, 'end_dates' => $arrayEnd_dateArray, 'names' => $arrayName, 'firstnames' => $arrayFirstname, 'idUser'=>$idUser,'datasHistoriqueReservationChezMoi' => $datasHistoriqueReservationChezMoi, 'contactsHistorique' => $arrayHistoriqueContacts, 'start_datesHistorique' => $arrayHistoriqueStart_date, 'end_datesHistorique' => $arrayHistoriqueEnd_dateArray, 'namesHistorique' => $arrayHistoriqueName, 'firstnamesHistorique' => $arrayHistoriqueFirstname, 'idUser'=>$idUser, 'likes'=>$datasLikes]);
        }
        if (isset($_POST['validerName'])) {
            $firstname = ($_POST['firstname']);
            $lastname = ($_POST['lastname']);
            $return = $model->setName($lastname, $firstname, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerMail'])) {
            $mail = ($_POST['mail']);
            $return = $model->setMail($mail, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerDateOfBird'])) {
            $dateOfBird = ($_POST['date_of_birth']);
            $return = $model->setDateOfBird($dateOfBird, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }
        if (isset($_POST['validerTel'])) {
            $tel = ($_POST['tel']);
            $return = $model->setTel($tel, $idUser);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso");
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
                echo "<meta http-equiv='refresh' content='0;url=/Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso'>";
            } else {
                echo "<script>alert(\"les donné saisi ne sont pas les meme\")</script>";
                echo "<meta http-equiv='refresh' content='0;url=/Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso'>";
            }
        }


        if (isset($_POST['validerTitle'])) {
            $title = ($_POST['title']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setTitle($title, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerAdresse'])) {
            $adresseSaisis = ($_POST['adresse']);
            $idLogement = ($_POST['idLogement']);
            $tableauAdresse = explode(", ", $adresseSaisis);
            $adresse = $tableauAdresse[0];
            $codePostale = $tableauAdresse[1];
            $city = $tableauAdresse[2];

            $return = $modelUpdate->setAdresse($adresse, $codePostale, $city, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerType'])) {
            $type = ($_POST['type']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setType($type, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerSurface'])) {
            $surface = ($_POST['surface']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setSurface($surface, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerLocation'])) {
            $location = ($_POST['location']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setLocation($location, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerPrice'])) {
            $price_by_night = ($_POST['price_by_night']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setPrice($price_by_night, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerPersone'])) {
            $number_of_person = ($_POST['number_of_person']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setPersone($number_of_person, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }
        if (isset($_POST['validerBeds'])) {
            $number_of_beds = ($_POST['number_of_beds']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setBeds($number_of_beds, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerDescription'])) {
            $description = ($_POST['description']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setDescription($description, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerResume'])) {
            $resume = ($_POST['resume']);
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setResume($resume, $idUser, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['validerEquipment'])) {
            $parking = isset($_POST['parking']) && $_POST['parking'] == 1 ? true : false;
            $wifi = isset($_POST['wifi']) &&  $_POST['wifi'] == 1 ? true : false;
            $piscine = isset($_POST['piscine']) &&  $_POST['piscine'] == 1 ? true : false;
            $animals = isset($_POST['animals']) && $_POST['animals'] == 1 ? true : false;
            $kitchen = isset($_POST['kitchen']) && $_POST['kitchen'] == 1 ? true : false;
            $garden = isset($_POST['garden']) && $_POST['garden'] == 1 ? true : false;
            $tv = isset($_POST['tv']) && $_POST['tv'] == 1 ? true : false;
            $climatisation = isset($_POST['climitisation']) && $_POST['climatisation'] == 1 ? true : false;
            $camera = isset($_POST['camera']) && $_POST['camera'] == 1 ? true : false;
            $home_textiles = isset($_POST['home_textiles']) && $_POST['home_textiles'] == 1 ? true : false;
            $spa = isset($_POST['spa']) &&  $_POST['spsuprimera'] == 1 ? true : false;
            $jacuzzi = isset($_POST['jacuzzi']) &&  $_POST['jacuzzi'] == 1 ? true : false;
            $idLogement = ($_POST['idLogement']);
            $return = $modelUpdate->setEquipment($parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $idUser, $jacuzzi, $idLogement);

            if ($return) {
                $datas = $model->getUser($idUser);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
                echo $twig->render('templateDashboard.html.twig', ['user' => $datas]);
            }
        }

        if (isset($_POST['suprimerImages'])) {
            $nameImage = ($_POST['inputHiddenPopop']);
            
            $suprimerImage = explode(',', $nameImage);
            var_dump($suprimerImage);
            $return = $modelUpdate->deleteImg($suprimerImage);
            header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
            exit();
        }

        if (isset($_POST['suprimerLogement'])) {
            var_dump($_POST);
            var_dump('coucou');
            $id_logement = ($_POST['inputHiddenPopop']);
            $delModel = new LogementModel();
            $delModel->delete($id_logement);
            header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentInfoPerso");
            exit();
        }

        if (isset($_POST['suprimerUser'])) {
            $delUser = new PersonModel();
            $delUser->deleteUser($idUser);
            session_destroy();
            header("Location: /Projet/homeaway1.0");
            exit();
        }

        if (isset($_POST['suprimerReservation'])) {
            $delReservation = new DashboardReservationModel();
            $id_resevation = ($_POST['inputHiddenPopop']);
            $startDate = $delReservation->selectDate($id_resevation); // Récupère la date de début
            $dt = strtotime($startDate['start_date']);
            $dateRservation5 = date("Y-m-d", strtotime("-5 day", $dt)); 
            if ($dateRservation5 >= $date) {
                
                $delReservation->deletResevation($id_resevation);
                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentMesReservation");
            } else {
                echo "<script>alert(\"Vous ne pouvez plus annuler cette réservation\")</script>";
                echo "<meta http-equiv='refresh' content='0;url=/Projet/homeaway1.0/dashboard?activeElement=contentMesReservation'>";
            }
        }

        

        if (isset($_POST['suprimerLike'])) {
            $deLike = new DashboardLikesModel();
            $id_logement = ($_POST['inputHiddenPopop']);
            $deLike->deleteLike($idUser, $id_logement);
            header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentLike");
            exit();
        }


        if (isset($_POST['submitAddLogement'])) {
            // var_dump($_POST);

            if (isset($_SESSION['id_person'])) {
                // var_dump('id_person is set');

                $id_person = $_SESSION['id_person'];
                $title = $_POST['title'];
                $type = $_POST['type'];
                var_dump($type);
                $surface = $_POST['surface'];
                $resume = $_POST['resume'];
                $description = $_POST['description'];
                $adress = $_POST['adress'];
                $adressCode = $_POST['adressCode'];
                $city = $_POST['city'];
                $location = $_POST['location'];
                $price_by_night = $_POST['price_by_night'];
                $number_of_person = $_POST['number_of_person'];
                $number_of_beds = $_POST['number_of_beds'];
                $parking = isset($_POST['parking+']) && $_POST['parking+'] == 1 ? true : false;
                $wifi = isset($_POST['wifi+']) &&  $_POST['wifi+'] == 1 ? true : false;
                $piscine = isset($_POST['piscine+']) &&  $_POST['piscine+'] == 1 ? true : false;
                $animals = isset($_POST['animals+']) && $_POST['animals+'] == 1 ? true : false;
                $kitchen = isset($_POST['kitchen+']) && $_POST['kitchen+'] == 1 ? true : false;
                $garden = isset($_POST['garden+']) && $_POST['garden+'] == 1 ? true : false;
                $tv = isset($_POST['tv+']) && $_POST['tv+'] == 1 ? true : false;
                $climatisation = isset($_POST['climitisation+']) && $_POST['climatisation+'] == 1 ? true : false;
                $camera = isset($_POST['camera+']) && $_POST['camera+'] == 1 ? true : false;
                $home_textiles = isset($_POST['home_textiles+']) && $_POST['home_textiles+'] == 1 ? true : false;
                $spa = isset($_POST['spa+']) &&  $_POST['spa+'] == 1 ? true : false;
                $jacuzzi = isset($_POST['jacuzzi+']) &&  $_POST['jacuzzi+'] == 1 ? true : false;

                $adresse = $adress . $adressCode . $city;

                // Préparer l'URL pour l'appel à l'API Google Maps Geocoding
                $apiUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($adresse) . '&key=AIzaSyBJOi0dF-SaAfjQDQogCfi0Ns5BDtZcJJU';

                // Effectuer l'appel à l'API
                $response = file_get_contents($apiUrl);

                // Analyser la réponse JSON
                $data = json_decode($response, true);

                // Vérifier si la requête s'est bien déroulée
                if ($data['status'] === 'OK') {
                    // Récupérer les coordonnées géographiques
                    $latitude = $data['results'][0]['geometry']['location']['lat'];
                    $longitude = $data['results'][0]['geometry']['location']['lng'];

                    // Insérer les coordonnées dans la base de données en utilisant le modèle
                }

                // crée une nouvelle instance de la classe LogementModel et la stocke dans la variable $img
                $img = new LogementModel();

                // initialise un tableau vide $thumbnailDatas. Ce tableau sera utilisé pour stocker les noms des fichiers des miniatures téléchargées.
                $thumbnailDatas = [];

                // compte le nombre de fichiers téléchargés dans la superglobale $_FILES et stocke le résultat dans la variable $nb.
                $nb = count($_FILES);
                function resizeImg($tmp_name, $width, $height, $name)
                {
                    // Récupération des dimensions de l'image d'origine
                    list($x, $y) = getimagesize($tmp_name);

                    // Calcul du ratio de redimensionnement en fonction des dimensions souhaitées
                    $ratio = min($width / $x, $height / $y);
                    $new_width = round($x * $ratio);
                    $new_height = round($y * $ratio);

                    // Récupération de l'extension du fichier
                    $ext = pathinfo($name, PATHINFO_EXTENSION);

                    switch ($ext) {
                        case 'jpg':
                        case 'jpeg':
                            $imageCreateFrom = 'imagecreatefromjpeg';
                            $imageExt = 'imagejpeg';
                            break;
                        case 'png':
                            $imageCreateFrom = 'imagecreatefrompng';
                            $imageExt = 'imagepng';
                            break;
                        case 'gif':
                            $imageCreateFrom = 'imagecreatefromgif';
                            $imageExt = 'imagegif';
                            break;
                        case 'webp':
                            $imageCreateFrom = 'imagecreatefromwebp';
                            $imageExt = 'imagewebp';
                            break;
                        default:
                            throw new Exception("Format d'image non pris en charge");
                    }

                    // Création d'une nouvelle image avec les nouvelles dimensions 
                    $image = $imageCreateFrom($tmp_name);
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

                    // Sauvegarde de l'image redimensionnée dans le répertoire
                    $imageExt($image_p, "./asset/img/logement/" . $name);
                }
                // boucle for itère à travers chaque fichier téléchargé en utilisant une variable d'index $i.
                for ($i = 1; $i <= $nb; $i++) {

                    // : Cette condition vérifie si le fichier téléchargé associé à l'index $i a été téléchargé sans erreur (UPLOAD_ERR_OK). Si c'est le cas, le bloc suivant est exécuté.

                    if ($_FILES['thumbnail_' . $i]['error'] === UPLOAD_ERR_OK) {

                        // Cette condition vérifie si le nom du fichier téléchargé pour l'index $i est défini. 

                        if (isset($_FILES['thumbnail_' . $i]['name'])) {;
                        }

                        // Cette ligne récupère le chemin temporaire du fichier téléchargé pour l'index $i dans la superglobale $_FILES et le stocke dans la variable $tmp_path.
                        $tmp_path = $_FILES['thumbnail_' . $i]['tmp_name'];

                        // Cette ligne génère un nouveau nom de fichier en utilisant l'index $i et le nom original du fichier téléchargé, en les concaténant avec le préfixe 'thumbnail_' et un underscore _.

                        $new_filename = 'thumbnail_' . $i . '_' . $_FILES['thumbnail_' . $i]['name'];

                        // Cette ligne génère le nouveau chemin complet où le fichier téléchargé sera déplacé. Dans cet exemple, les fichiers seront stockés dans le répertoire 'C:/wamp64/www/Projet/homeaway1.0/asset/img/' avec le nouveau nom de fichier.
                        $new_path = './asset/img/logement/' . $new_filename;

                        // Cette ligne déplace le fichier téléchargé du chemin temporaire ($tmp_path) vers le nouveau chemin spécifié ($new_path). Ainsi, le fichier est déplacé du répertoire temporaire du serveur vers le répertoire de destination choisi.
                        move_uploaded_file($tmp_path, $new_path);

                        // Cette ligne ajoute un nouvel élément au tableau $thumbnailDatas. L'élément est un tableau associatif avec une clé 'thumbnail' et la valeur est le nom du fichier généré pour l'index $i. Ainsi, le tableau $thumbnailDatas contiendra tous les noms des fichiers des miniatures téléchargées.

                        $thumbnailDatas[] = [
                            'thumbnail' => $new_filename
                        ];
                        // le tableau $thumbnailDatas contiendra les noms de tous les fichiers des miniatures téléchargées, et vous pouvez utiliser ce tableau pour les enregistrer dans la base de données ou les traiter d'une autre manière dans le modèle LogementModel.


                        // Appel de la fonction resizeImg() avec les paramètres suivants :
                        // - Le chemin temporaire de l'image dans $_FILES['thumbnail']
                        // - Les dimensions de largeur et de hauteur souhaitées (300x300 dans ce cas)
                        // - Le nom de fichier dans $_FILES['thumbnail']

                        // Cette condition vérifie si le fichier thumbnail a été téléchargé avec succès (UPLOAD_ERR_OK). La superglobale $_FILES est utilisée pour vérifier l'existence du fichier et s'assurer qu'il n'y a pas d'erreur lors du téléchargement.
                        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                            // : Si la condition est vraie, cette ligne appelle la fonction resizeImg() pour redimensionner l'image thumbnail. Les paramètres passés à la fonction sont les suivants :
                            resizeImg($_FILES['thumbnail']['tmp_name'], 300, 300, $_FILES['thumbnail']['name']);
                        }
                    }
                }
                $logementmodel = new LogementModel();
                $idLogement = $logementmodel->addFlat($id_person, $title, $type, $surface, $resume, $description, $adress, $adressCode, $city, $location,  $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi, $latitude, $longitude);
                $thumbnailImg = $img->getUpload($thumbnailDatas, $idLogement);

                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentAjoutLogement");
            } else {
                $twig = $this->getTwig();
                echo $twig->render('templateDashboard.html.twig', []);
            }
        }


        if (isset($_POST['validerImages'])) {
            var_dump($_POST);
            var_dump('coucou');

            if (isset($_SESSION['id_person'])) {
                // var_dump('id_person is set');
                $idLogement = ($_POST['idLogement']);



                // crée une nouvelle instance de la classe LogementModel et la stocke dans la variable $img
                $img = new LogementModel();

                // initialise un tableau vide $thumbnailDatas. Ce tableau sera utilisé pour stocker les noms des fichiers des miniatures téléchargées.
                $thumbnailDatas = [];

                // compte le nombre de fichiers téléchargés dans la superglobale $_FILES et stocke le résultat dans la variable $nb.
                $nb = count($_FILES);

                function resizeImg($tmp_name, $width, $height, $name)
                {
                    // Récupération des dimensions de l'image d'origine
                    list($x, $y) = getimagesize($tmp_name);

                    // Calcul du ratio de redimensionnement en fonction des dimensions souhaitées
                    $ratio = min($width / $x, $height / $y);
                    $new_width = round($x * $ratio);
                    $new_height = round($y * $ratio);

                    // Récupération de l'extension du fichier
                    $ext = pathinfo($name, PATHINFO_EXTENSION);

                    switch ($ext) {
                        case 'jpg':
                        case 'jpeg':
                            $imageCreateFrom = 'imagecreatefromjpeg';
                            $imageExt = 'imagejpeg';
                            break;
                        case 'png':
                            $imageCreateFrom = 'imagecreatefrompng';
                            $imageExt = 'imagepng';
                            break;
                        case 'gif':
                            $imageCreateFrom = 'imagecreatefromgif';
                            $imageExt = 'imagegif';
                            break;
                        case 'webp':
                            $imageCreateFrom = 'imagecreatefromwebp';
                            $imageExt = 'imagewebp';
                            break;
                        default:
                            throw new Exception("Format d'image non pris en charge");
                    }

                    // Création d'une nouvelle image avec les nouvelles dimensions 
                    $image = $imageCreateFrom($tmp_name);
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

                    // Sauvegarde de l'image redimensionnée dans le répertoire
                    $imageExt($image_p, "./asset/img/logement/" . $name);
                }
                // boucle for itère à travers chaque fichier téléchargé en utilisant une variable d'index $i.
                for ($i = 1; $i <= $nb; $i++) {

                    // : Cette condition vérifie si le fichier téléchargé associé à l'index $i a été téléchargé sans erreur (UPLOAD_ERR_OK). Si c'est le cas, le bloc suivant est exécuté.

                    if ($_FILES['thumbnail_' . $i]['error'] === UPLOAD_ERR_OK) {

                        // Cette condition vérifie si le nom du fichier téléchargé pour l'index $i est défini. 

                        if (isset($_FILES['thumbnail_' . $i]['name'])) {;
                        }

                        // Cette ligne récupère le chemin temporaire du fichier téléchargé pour l'index $i dans la superglobale $_FILES et le stocke dans la variable $tmp_path.
                        $tmp_path = $_FILES['thumbnail_' . $i]['tmp_name'];

                        // Cette ligne génère un nouveau nom de fichier en utilisant l'index $i et le nom original du fichier téléchargé, en les concaténant avec le préfixe 'thumbnail_' et un underscore _.

                        $new_filename = 'thumbnail_' . $i . '_' . $_FILES['thumbnail_' . $i]['name'];

                        // Cette ligne génère le nouveau chemin complet où le fichier téléchargé sera déplacé. Dans cet exemple, les fichiers seront stockés dans le répertoire 'C:/wamp64/www/Projet/homeaway1.0/asset/img/' avec le nouveau nom de fichier.
                        $new_path = './asset/img/logement/' . $new_filename;

                        // Cette ligne déplace le fichier téléchargé du chemin temporaire ($tmp_path) vers le nouveau chemin spécifié ($new_path). Ainsi, le fichier est déplacé du répertoire temporaire du serveur vers le répertoire de destination choisi.
                        move_uploaded_file($tmp_path, $new_path);

                        // Cette ligne ajoute un nouvel élément au tableau $thumbnailDatas. L'élément est un tableau associatif avec une clé 'thumbnail' et la valeur est le nom du fichier généré pour l'index $i. Ainsi, le tableau $thumbnailDatas contiendra tous les noms des fichiers des miniatures téléchargées.

                        $thumbnailDatas[] = [
                            'thumbnail' => $new_filename
                        ];
                        // le tableau $thumbnailDatas contiendra les noms de tous les fichiers des miniatures téléchargées, et vous pouvez utiliser ce tableau pour les enregistrer dans la base de données ou les traiter d'une autre manière dans le modèle LogementModel.


                        // Appel de la fonction resizeImg() avec les paramètres suivants :
                        // - Le chemin temporaire de l'image dans $_FILES['thumbnail']
                        // - Les dimensions de largeur et de hauteur souhaitées (300x300 dans ce cas)
                        // - Le nom de fichier dans $_FILES['thumbnail']

                        // Cette condition vérifie si le fichier thumbnail a été téléchargé avec succès (UPLOAD_ERR_OK). La superglobale $_FILES est utilisée pour vérifier l'existence du fichier et s'assurer qu'il n'y a pas d'erreur lors du téléchargement.
                        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                            // : Si la condition est vraie, cette ligne appelle la fonction resizeImg() pour redimensionner l'image thumbnail. Les paramètres passés à la fonction sont les suivants :
                            resizeImg($_FILES['thumbnail']['tmp_name'], 300, 300, $_FILES['thumbnail']['name']);
                        }
                    }
                }
                $logementmodel = new LogementModel();

                $thumbnailImg = $img->getUpload($thumbnailDatas, $idLogement);

                header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentGestionLogement");
            } else {
                $twig = $this->getTwig();
                echo $twig->render('templateDashboard.html.twig', []);
            }
        }
    }
}
