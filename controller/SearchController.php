<?php

class SearchController extends Controller{

            public function searchLogement()
        {
            if (isset($_POST['submit'])) {
                $city = $_POST['city'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $number_of_person = $_POST['number_of_person'];
    
                $model = new SearchModel;
                $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person);
                var_dump($datas[0]->getPrice_by_night());
                $totalPrices =[];
                foreach ($datas as $data) {
                    $logement = $data; // Récupérer l'objet Logement depuis $data
    
                    $price_by_night = $logement->getPrice_by_night();
                    $start = new DateTime($start_date);
                    $end = new DateTime($end_date);
                    $number_of_days = $start->diff($end)->days;
                    array_push($totalPrices, $price_by_night * $number_of_days);
                }
                var_dump($totalPrices);
            }
            $twig = $this->getTwig();
            echo $twig->render('resultsearch.html.twig', ['logementDispo' => $datas, 'totalPrices' => $totalPrices]);
    
            if (empty($datas)) {
                echo "Aucun logement ne correspond à votre recherche.";
            }
        
    }
    }
// public function searchLogement (){
//     if(isset($_POST['submit'])) {
//         $city = $_POST['city'];
//         $start_date = $_POST['start_date'];
//         $end_date = $_POST['end_date'];
//         $number_of_person = $_POST['number_of_person'];

//         $model= new SearchModel;
//         $datas = $model->getSearch($city,$start_date,$end_date, $number_of_person);

//         foreach ($datas as $data) {
//             $price_by_night = $data['price_by_night'];
//             $start = new DateTime($start_date);
//             $end = new DateTime($end_date);
//             $number_of_days = $start->diff($end)->days;
//             $total_price = $price_by_night * $number_of_days;

//             $data['number_of_days'] = $number_of_days;
//             $data['total_price'] = $total_price;
//         }
//     }
//     $twig = $this->getTwig();
//     echo $twig->render('resultsearch.html.twig', ['logementDispo' => $datas]);

//     if (empty($datas)) {
//         echo "Aucun logement ne correspond à votre recherche.";
//     }
// }
