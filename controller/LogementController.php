<?php
class LogementController extends Controller
{
    public function addLogement()
    {

        global $router;
        //echo 'test';

        if (!$_POST) {
            // var_dump('je suis en GET');
            $twig = $this->getTwig();
            echo $twig->render('addLogement.html.twig', []);
        } else {


            if (isset($_POST['submit'])) {
                // var_dump($_POST);

                if (isset($_SESSION['id_person'])) {
                    // var_dump('id_person is set');

                    $id_person = $_SESSION['id_person'];
                    $title = $_POST['title'];
                    $type = $_POST['type'];
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
                    $spa = isset($_POST['spa']) &&  $_POST['spa'] == 1 ? true : false;
                    $jacuzzi = isset($_POST['jacuzzi']) &&  $_POST['jacuzzi'] == 1 ? true : false;

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

                    header('Location:./add');
                } else {
                    $twig = $this->getTwig();
                    echo $twig->render('addLogement.html.twig', []);
                }
            } else {
                $message = 'Oops, something went wrong sorry. Try again later';
                $twig = $this->getTwig();
                echo $twig->render('homePage.html.twig', ['message' => $message]);
            }
        }
    }



    public function getOneCity($id_ville)
    {
        global $router;

        $model = new LogementModel();
        $logement = $model->getCity($id_ville);
        $oneLogement = $router->generate('city', ['id' => $id_ville]);
        
        $twig = $this->getTwig();
        echo $twig->render('logementCity.html.twig', ['logement' => $logement, 'oneLogement' => $oneLogement]);
    }


    public function getOneLogement($id_logement)
    {
        global $router;

        $modelLogement = new LogementModel();
        $modelBook = new BookModel();
        $onelogement = $modelLogement->getOne($id_logement);
        $allImg = $modelLogement->getAllImg($id_logement);
        $allBook = $modelBook->getBookHold($id_logement);

        $twig = $this->getTwig();
        echo $twig->render('oneLogement.html.twig', ['onelogement' => $onelogement, 'allImg' => $allImg, 'books' => $allBook]);
    }

    public function filterLogement()
    {
        global $router;

        // Récupérez les filtres sélectionnés depuis le formulaire
        $selectedFilters = $_POST["filters"] ?? [];
        $submit = $_POST["submit"];

        var_dump($_POST);

        $logementModel = new LogementModel();
        $filterLogement = $logementModel->logementFilters($selectedFilters);

        header('Location:./search');
        exit();

        // $twig = $this->getTwig();
        // echo $twig->render('resultsearch.html.twig', ['filterLogement' => $filterLogement]);
    }


    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }


    public function sendMail()
    {
        if (!$_POST) {

            $twig = $this->getTwig();
            echo $twig->render('formContact.html.twig', []);
        } else {


            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $surname = $_POST['surname'];              
                $email = $_POST['email'];
                $message = $_POST['message'];


                $entete  = 'MIME-Version: 1.0' . "\r\n";
                $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $entete .= 'From: alexandre.sequeira@bobasdev.com' . "\r\n";
                $entete .= 'Reply-To: ' . $email . "\r\n";

                $emailContent = "<h3>" . $name . " " . $surname . "</h3>";
                $emailContent .= "<p>" . htmlspecialchars($message) . "</p>";
                

                $retour = mail('alexandre.sequeira01@gmail.com', 'Envoi depuis page Contact', $emailContent, $entete);
                if ($retour) {
                    echo '<p>Votre message a bien été envoyé.</p>';
                    header('Location:./');
                    exit();
                }
            }
        }
    }
    // -*-*-*-*METHOD PAGE ONE LOGEMENT CONTACT HOTE  -*-*-*-*//
    public function contactMe()
    {
        $twig = $this->getTwig();
        echo $twig->render('contactHote.html.twig', []);
    }
    // public function addFavorite()
    // {
    //     $modelLogement = new LogementModel();
       
    //     $modelLogement->favorite($_POST['id_logement'], $_SESSION['id_person']);
    //     header('Location:./search');
    //                 exit();
    // }
    public function addFavorite()
{
    $modelLogement = new LogementModel();

   
    $id_logement = $_POST['id_logement'];
    $id_person = $_SESSION['id_person'];
    var_dump($id_person, $id_logement);
    $modelLogement->favorite( $id_logement , $id_person );
   // Préparez les données de réponse JSON
    $response = array(
        'status' => 'success',
        'message' => 'Le logement a été ajouté aux favoris.'
    );

    // Convertissez les données en JSON et renvoyez la réponse
    echo json_encode($response);
}
public function deleteFavorite()
{
    $modelLogement = new LogementModel();

    $id_logement = $_POST['id_logement'];
    $id_person = $_SESSION['id_person'];

    $modelLogement->delFavorite($id_person, $id_logement);

    // Préparez les données de réponse JSON
    $response = array(
        'status' => 'success',
        'message' => 'Le logement a été supprimé des favoris.'
    );

    // Convertissez les données en JSON et renvoyez la réponse
    echo json_encode($response);
}
public function getLike()
{
    $modelLogement = new LogementModel();
    $id_logement = $_POST['id_logement'];
    $id_person = $_SESSION['id_person'];

    $results = $modelLogement->like($id_person, $id_logement);

    
    $_SESSION['like_status'] = $results;

    $twig = $this->getTwig();
    echo $twig->render('resultSearch.html.twig', ['results' => $results]);
}

}
