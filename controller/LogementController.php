<?php
class LogementController extends Controller {
    public function homepage() {
     
        echo self::getRender('homePage.html.twig', []);
    }
    public function legalNotices() {
        $twig = $this-> getTwig();
        echo $twig->render('legalNotices.html.twig',[]);
    }

    public function addLogement(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $id_person = $_POST['id_person'];
            $title = $_POST['title'];
            $type = $_POST['type'];
            $surface = $_POST['surface'];
            $description = $_POST['description'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $price_by_night = $_POST['price_by_night'];
            $number_of_person = $_POST['number_of_person'];
            $number_of_beds = $_POST['number_of_beds'];
            $parking = isset($_POST['parking']) ? 1 : 0;
            $wifi = isset($_POST['wifi']) ? 1 : 0;
            $piscine = isset($_POST['piscine']) ? 1 : 0;
            $animals = isset($_POST['animals']) ? 1 : 0;
            $kitchen = isset($_POST['kitchen']) ? 1 : 0;
            $garden = isset($_POST['garden']) ? 1 : 0;
            $tv = isset($_POST['tv']) ? 1 : 0;
            $climatisation = isset($_POST['climatisation']) ? 1 : 0;
            $camera = isset($_POST['camera']) ? 1 : 0;
            $home_textiles = isset($_POST['home_textiles']) ? 1 : 0;
            $spa = isset($_POST['spa']) ? 1 : 0;
            $jacuzzi = isset($_POST['jacuzzi']) ? 1 : 0;
            // $thumbnail = $_POST['thumbnail'];
        
            $logementModel = new LogementModel();

            $logementModel->addFlat($id_person, $title, $type, $surface, $description, $address, $city, $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi);
            // $id_logement = $req ->insert_id;
            // $logementModel->addImage($id_logement, $thumbnail);
        
            // global $router;
            // header('Location: ' . $router->generate('add'));
            echo self::getRender('homePage.html.twig', []);
            // exit();
        
        } else {
            echo self::getRender('addLogement.html.twig', []);
           
        }
        
        // $req->close();
    }


   
}
