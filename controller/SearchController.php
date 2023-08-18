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
            $modelLogement = new LogementModel();
            
            $id_person = $_SESSION['id_person'];
        
            $results = $modelLogement->like($id_person);
            var_dump($results);
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
                'formValue' => $formValue,
                'results'=> $results
            ]);
            echo $resultSearchView;

            if (empty($datas)) {

                $resultSearchView .= "Aucun logement ne correspond à votre recherche.";
            }

            return $resultSearchView;
        }
    }




    public function applyFilter()
    {  
        
        if (isset($_POST['city'])) {
            $city = $_POST['city'];
        }
        

        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        }
        

        if (isset($_POST['end_date'])) {
            $end_date = $_POST['end_date'];
        }
       

        if (isset($_POST['number_of_person'])) {
            $number_of_person = $_POST['number_of_person'];
        }
       

        $formValue = [];
        $formValue['city'] = $city;
        $formValue['start'] = $start_date;
        $formValue['end'] = $end_date;
        $formValue['person'] = $number_of_person;

      

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrayFilter = [];
            foreach($_POST['filters'] as $value){
                $arrayFilter[$value] = 1;
            }
            
            var_dump($arrayFilter);
            $modelFilter = new SearchModel;
            $datas=$modelFilter->searchAccommodations($city, $start_date, $end_date, $number_of_person, $arrayFilter);
            $totalPrices = [];
            foreach ($datas as $logementComplet) {
    
                $price_by_night = $logementComplet['price_by_night'];
                $start = new DateTime($start_date);
                $end = new DateTime($end_date);
                $number_of_days = $start->diff($end)->days;
                array_push($totalPrices, $price_by_night * $number_of_days);
            }

            $twig = $this->getTwig();

            $resultsView = $twig->render('filterView.html.twig', ['logementDispo'=>$datas, 'formValue' => $formValue, 'totalPrices' => $totalPrices]);
            echo $resultsView;
        } else {
            $twig = $this->getTwig();
            $message = 'Aucun logement ne correspond à votre recheche.';

            $resultsView = $twig->render('filterView.html.twig', ['message' => $message]);
        }
    }


    public function searchByCity($city)
    {
       
        $number_of_person = 2;
        $model = new SearchModel();
        $logements = $model->getLogementsByVille($city, $number_of_person);
        $modelLogement = new LogementModel();
            
            $id_person = $_SESSION['id_person'];
        
            $results = $modelLogement->like($id_person);

        $twig = $this->getTwig();
        $logementsView = $twig->render('logementCity.html.twig', [
            'logements' => $logements,
            'city' => $city,
            'results'=> $results
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
        $modelLogement = new LogementModel();
            
        $id_person = $_SESSION['id_person'];
    
        $results = $modelLogement->like($id_person);
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
            'results'=> $results
            
            // 'totalPrices' => $totalPrices, 
        ]);
        echo $logementsTypeView;
    }
}
