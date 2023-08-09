<?php

class SearchController extends Controller
{

    // public function searchLogement()
    // {

    //     if (isset($_POST['submit']) || isset($_POST['id_logement'])) {

    //         $city = ucfirst($_POST['city']);
    //         $start_date = $_POST['start_date'];
    //         $end_date = $_POST['end_date'];
    //         $number_of_person = $_POST['number_of_person'];
   
    //         $formValue = [];
    //         $formValue['city'] = $city;
    //         $formValue['start'] = $start_date;
    //         $formValue['end'] = $end_date;
    //         $formValue['person'] = $number_of_person;

    //         $model = new SearchModel;
    //         $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person);

    //         $dataUpdated = [];
    //         $totalPrices = [];
    //         foreach ($datas as $logementComplet) {

    //             $price_by_night = $logementComplet['price_by_night'];
    //             $start = new DateTime($start_date);
    //             $end = new DateTime($end_date);
    //             $number_of_days = $start->diff($end)->days;
    //             array_push($totalPrices, $price_by_night * $number_of_days);
    //             $dataUpdated[] = $logementComplet;
    //         }
    //     }

    //     $twig = $this->getTwig();

    //         $resultSearchView = $twig->render('resultsearch.html.twig', [
    //             'logementDispo' => $datas,
    //             'totalPrices' => $totalPrices,
    //             'formValue' => $formValue
    //         ]);
    //         echo $resultSearchView;

    //         if (empty($datas)) {
    //             echo "Aucun logement ne correspond à votre recherche.";
    //         }
 
    // }
    // public function applyFilters()
    // {
    //     if (isset($_POST['filters'])) {
    //         $city = ucfirst($_POST['city']);
    //         $start_date = $_POST['start_date'];
    //         $end_date = $_POST['end_date'];
    //         $number_of_person = $_POST['number_of_person'];
            
    //         $filtresSelectionnes = $_POST['filters']; // Filtres sélectionnés
            
    //         $formValue = [];
    //         $formValue['city'] = $city;
    //         $formValue['start'] = $start_date;
    //         $formValue['end'] = $end_date;
    //         $formValue['person'] = $number_of_person;
            
    //         // Appeler le modèle pour obtenir les résultats filtrés
    //         $model = new SearchModel;
    //         $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person, $filtresSelectionnes);
    
    //         // ... traitement des résultats filtrés ...
    
    //         $twig = $this->getTwig();
    
    //         $resultSearchView = $twig->render('resultsearch.html.twig', [
    //             'logementDispo' => $datas,
    //             'formValue' => $formValue
    //         ]);
    //         echo $resultSearchView;
    
    //         if (empty($datas)) {
    //             echo "Aucun logement ne correspond à votre recherche.";
    //         }
    //     }
    // }
    // public function searchLogement()
    // {
    //     if (isset($_POST['submit']) || isset($_POST['id_logement'])) {
    //         $city = ucfirst($_POST['city']);
    //         $start_date = $_POST['start_date'];
    //         $end_date = $_POST['end_date'];
    //         $number_of_person = $_POST['number_of_person'];
    
    //         $formValue = [
    //             'city' => $city,
    //             'start' => $start_date,
    //             'end' => $end_date,
    //             'person' => $number_of_person
    //         ];
    
    //         $model = new SearchModel;
    //         $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person, []);
    
    //         $totalPrices = [];
    //         foreach ($datas as $logementComplet) {
    //             $price_by_night = $logementComplet['price_by_night'];
    //             $start = new DateTime($start_date);
    //             $end = new DateTime($end_date);
    //             $number_of_days = $start->diff($end)->days;
    //             array_push($totalPrices, $price_by_night * $number_of_days);
    //         }
    
    //         $twig = $this->getTwig();
    
    //         $resultSearchView = $twig->render('resultsearch.html.twig', [
    //             'logementDispo' => $datas,
    //             'totalPrices' => $totalPrices,
    //             'formValue' => $formValue
    //         ]);
    //         echo $resultSearchView;
    
    //         if (empty($datas)) {
    //             echo "Aucun logement ne correspond à votre recherche.";
    //         }
    //     }
    // }
    
    // public function applyFilters()
    // {
    //     if (isset($_POST['filters'])) {
    //         $city = ucfirst($_POST['city']);
    //         $start_date = $_POST['start_date'];
    //         $end_date = $_POST['end_date'];
    //         $number_of_person = $_POST['number_of_person'];
            
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
    //             echo "Aucun logement ne correspond à votre recherche.";
    //         }
    //     }
    // }
    
    public function searchLogement()
    {
        if (isset($_POST['submit']) || isset($_POST['id_logement'])) {
            $city = isset($_POST['city']) ? ucfirst($_POST['city']) : '';
        $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
        $number_of_person = isset($_POST['number_of_person']) ? $_POST['number_of_person'] : '';
    
            $formValue = [
                'city' => $city,
                'start' => $start_date,
                'end' => $end_date,
                'person' => $number_of_person
            ];
    
            $model = new SearchModel;
            $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person, []);
    
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
    
    public function applyFilters()
    {
        if (isset($_POST['filters'])) {
            $city = isset($_POST['city']) ? ucfirst($_POST['city']) : '';
            $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
            $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
            $number_of_person = isset($_POST['number_of_person']) ? $_POST['number_of_person'] : '';
    
    
            $filtresSelectionnes = $_POST['filters'];
    
            $formValue = [
                'city' => $city,
                'start' => $start_date,
                'end' => $end_date,
                'person' => $number_of_person
            ];
    
            $model = new SearchModel;
            $datas = $model->getSearch($city, $start_date, $end_date, $number_of_person, $filtresSelectionnes);
    
            $twig = $this->getTwig();
    
            $resultSearchView = $twig->render('resultsearch.html.twig', [
                'logementDispo' => $datas,
                'formValue' => $formValue
            ]);
            echo $resultSearchView;

            if (empty($datas)) {
                $resultSearchView .= "Aucun logement ne correspond à votre recherche.";
            }
    
            return $resultSearchView;
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
        
       
    
    
    
    
