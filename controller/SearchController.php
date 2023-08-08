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
                $dataUpdated[] = $logementComplet;
            }
        }

        $twig = $this->getTwig();
     
            $resultSearchView = $twig->render('resultsearch.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $resultSearchView;

            if (empty($datas)) {
                echo "Aucun logement ne correspond à votre recherche.";
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
        
       
    
    
    
    
