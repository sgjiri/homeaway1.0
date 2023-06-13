<?php
class LogementController extends Controller
{
    public function homepage()
    {

        echo self::getRender('homePage.html.twig', []);
    }

    public function addLogement()
    {
        global $router;

        if (!$_POST) {
            echo self::getRender('addLogement.html.twig', []);
        } else {
            if (isset($_POST['submit'])) {
                if (isset($_SESSION['id'])) {

                    $id_person = $_SESSION['id'];
                    $title = $_POST['title'];
                    $type = $_POST['type'];
                    $surface = $_POST['surface'];
                    $description = $_POST['description'];
                    $adress = $_POST['adress'];
                    $city = $_POST['city'];
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



                    $logement = new Logement(

                        [
                            'id_person' => $id_person,
                            'title' => $title,
                            'type' => $type,
                            'surface' => $surface,
                            'description' => $description,
                            'adress' => $adress,
                            'city' => $city,
                            'price_by_night' => $price_by_night,
                            'number_of_person' => $number_of_person,
                            'number_of_beds' => $number_of_beds,
                            'parking' => $parking,
                            'wifi' => $wifi,
                            'piscine' => $piscine,
                            'animals' => $animals,
                            'kitchen' => $kitchen,
                            'garden' => $garden,
                            'tv' => $tv,
                            'climatisation' => $climatisation,
                            'camera' => $camera,
                            'home_textiles' => $home_textiles,
                            'spa' => $spa,
                            'jacuzzi' => $jacuzzi,

                        ]
                    );

                    $logementmodel = new LogementModel();
                    $logementmodel->addFlat($logement);
                    echo self::getRender('addLogement.html.twig', []);
                } else {
                   
                    echo self::getRender('addLogement.html.twig', []);
                }
            } else {
                $message = 'Oops, something went wrong sorry. Try again later';
                echo self::getRender('homePage.html.twig', ['message' => $message]);
            }
        }
    }
}     
      
        


   

    //     echo self::getRender('homePage.html.twig', []);

    //             } else {
    //                 echo self::getRender('addLogement.html.twig', []);
        
    // }
