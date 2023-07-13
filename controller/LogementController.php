<?php
class LogementController extends Controller
{
    public function addLogement()
    {

        global $router;

        if (!$_POST) {
            $twig = $this->getTwig();
            echo $twig->render('addLogement.html.twig', []);
        } else {

            if (isset($_POST['submit'])) {

                if (isset($_SESSION['id_person'])) {

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


                        // Charger le modèle approprié
                        // require_once 'models/LogementModel.php';

                        // Insérer les coordonnées dans la base de données en utilisant le modèle
                    }

                    $logementmodel = new LogementModel();
                    $logementmodel->addFlat($id_person, $title, $type, $surface, $resume, $description, $adress, $adressCode, $city, $location,  $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi, $latitude, $longitude);

                    // Conversion des données d'image en format JSON et envoi de la réponse
                    echo json_encode($logementmodel);

                    // $twig = $this->getTwig();
                    // echo $twig->render('addLogement.html.twig', []);
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


    public function getUploadImg()
    {

        global $router;

        // instance de la classe LogementModel
        $img = new LogementModel();

        // Appel de la méthode getUpload() de l'objet $img avec les paramètres suivants :
        // - La valeur de $_POST['id_logement']
        // - L'objet $_FILES['thumbnail']

        $datasImage = $img->getUpload(

            $_POST['id_logement'],
            $_FILES['thumbnail']
        );

        // Vérification si les variables $_POST['id_logement'] et $_FILES['thumbnail'] sont définies

        if (isset(
            $_POST['id_logement'],
            $_FILES['thumbnail']

        )) {
            // // Définition d'une fonction locale pour redimensionner une image
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

            // Appel de la fonction resizeImg() avec les paramètres suivants :
            // - Le chemin temporaire de l'image dans $_FILES['thumbnail']
            // - Les dimensions de largeur et de hauteur souhaitées (300x300 dans ce cas)
            // - Le nom de fichier dans $_FILES['thumbnail']
            resizeImg($_FILES['thumbnail']['tmp_name'], 300, 300, $_FILES['thumbnail']['name']);
        }

        $twig = $this->getTwig();
        echo $twig->render('addLogement.html.twig', ['datasImage'=>$datasImage]);
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



    public function getAllLogement()
    {
        global $router;
        $model = new LogementModel();
        $ville = $model->getAll();

        $twig = $this->getTwig();

        echo $twig->render('logementCity.html.twig', ['logements' => $ville]);
    }



    public function getOneLogement()
    {
        $twig = $this->getTwig();
        echo $twig->render('oneLogement.html.twig', []);
    }
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }
}
