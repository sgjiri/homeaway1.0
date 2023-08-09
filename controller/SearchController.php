<?php

class SearchController extends Controller
{

    public function searchLogement()
    {

        if (isset($_POST['submit']) || isset($_POST['id_logement'])) {

            $city = ucfirst($_POST['city']);
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $number_of_person = $_POST['number_of_person'];

            $formValue = [];
            $formValue['city'] = $city;
            $formValue['start'] = $start_date;
            $formValue['end'] = $end_date;
            $formValue['person'] = $number_of_person;

            $model = new SearchModel;
            $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person);

            $dataUpdated = [];
            $totalPrices = [];
            foreach ($datas as $logementComplet) {

                $price_by_night = $logementComplet['price_by_night'];
                $start = new DateTime($start_date);
                $end = new DateTime($end_date);
                $number_of_days = $start->diff($end)->days;
                array_push($totalPrices, $price_by_night * $number_of_days);
            }

            $twig = $this->getTwig();

            $resultSearchView = $twig->render('resultsearch.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $resultSearchView;

            if (empty($datas)) {

                $resultSearchView .= "Aucun logement ne correspond à votre recherche.";
            }

            return $resultSearchView;
        }
    }

    // public function applyFilters()
    // {
    //     if (isset($_POST['filters'])) {
    //         $city = isset($_POST['city']) ? ucfirst($_POST['city']) : '';
    //         $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    //         $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
    //         $number_of_person = isset($_POST['number_of_person']) ? $_POST['number_of_person'] : '';


    //         $filtresSelectionnes = $_POST['filters'];

    //         $formValue = [
    //             'city' => $city,
    //             'start' => $start_date,
    //             'end' => $end_date,
    //             'person' => $number_of_person
    //         ];

    //         $model = new SearchModel;
    //         $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person, $filtresSelectionnes);

    //         $twig = $this->getTwig();

    //         $resultSearchView = $twig->render('resultsearch.html.twig', [
    //             'logementDispo' => $datas,
    //             'formValue' => $formValue
    //         ]);
    //         echo $resultSearchView;

    //         if (empty($datas)) {
    //             $resultSearchView .= "Aucun logement ne correspond à votre recherche.";
    //         }

    //         return $resultSearchView;
    //     }
    // }


   
    public function applyFilter()
    {

        if (isset($_POST['city'])) {
            $city = $_POST['city'];
        } else {
            $city = '';
        }

        if (isset($_POST['start_date'])) {
            $startDate = $_POST['start_date'];
        } else {
            $startDate = '';
        }

        if (isset($_POST['end_date'])) {
            $endDate = $_POST['end_date'];
        } else {
            $endDate = '';
        }

        if (isset($_POST['number_of_persons'])) {
            $numberOfPersons = $_POST['number_of_persons'];
        } else {
            $numberOfPersons = 1; // Valeur par défaut si non spécifiée
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $wifi = isset($_POST['wifi']) ? 1 : 0;
            $parking = isset($_POST['parking']) ? 1 : 0;
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

            var_dump($_POST);
            $modelFilter = new SearchModel;
            $results = $modelFilter->searchAccommodations($city, $startDate, $endDate, $numberOfPersons, $wifi, $parking, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi);


            $twig = $this->getTwig();

            $results = $twig->render('resultsearch.html.twig', []);
            echo $results;
        } else {
            $twig = $this->getTwig();
            $message = 'Aucun logement ne correspond à votre recheche.';

            $results = $twig->render('resultsearch.html.twig', ['message' => $message]);
        }
    }


    public function searchByCity($city)
    {

        $number_of_person = 2;
        $model = new SearchModel();
        $logements = $model->getLogementsByVille($city, $number_of_person);
        // var_dump($logements);
        $dataUpdated = [];
        // $totalPrices = [];

        foreach ($logements as $logementComplet) {
            $price_by_night = $logementComplet['price_by_night'];
            // $start = new DateTime($start_date);
            // $end = new DateTime($end_date);
            // $number_of_days = $start->diff($end)->days;
            // array_push($totalPrices, $price_by_night * $number_of_days);
            $dataUpdated[] = $logementComplet;
        }

        $twig = $this->getTwig();
        $logementsView = $twig->render('logementCity.html.twig', [
            'logements' => $logements,
            'city' => $city,
            // 'totalPrices' => $totalPrices, 
        ]);
        echo $logementsView;
    }

    public function searchByType($type)
    {

        $number_of_person = 2;
        $model = new SearchModel();
        $logementsTypes = $model->getLogementsByType($type, $number_of_person);
        // var_dump($logements);
        $dataUpdated = [];
        // $totalPrices = [];

        foreach ($logementsTypes as $logementComplet) {
            $price_by_night = $logementComplet['price_by_night'];
            // $start = new DateTime($start_date);
            // $end = new DateTime($end_date);
            // $number_of_days = $start->diff($end)->days;
            // array_push($totalPrices, $price_by_night * $number_of_days);
            $dataUpdated[] = $logementComplet;
        }

        $twig = $this->getTwig();
        $logementsTypeView = $twig->render('logementType.html.twig', [
            'logementsTypes' => $logementsTypes,
            'type' => $type,
            // 'totalPrices' => $totalPrices, 
        ]);
        echo $logementsTypeView;
    }
}
