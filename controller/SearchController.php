<?php

class SearchController extends Controller
{

    public function searchLogement()
    {

        if (isset($_POST['submit']) || isset($_POST['id_logement'])){
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

        if (isset($_POST['check'])) {

            $resultSearchView = $twig->render('resultsearch.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $resultSearchView;

            if (empty($datas)) {
                echo "Aucun logement ne correspond à votre recherche.";
            }
        } elseif (isset($_POST['id_logement'])) {
            $oneLogementView = $twig->render('oneLogement.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $oneLogementView;

        }
    }

    public function searchBeach()
{
    if ($_POST) {
        // Récupérer les valeurs de $_POST pour $start_date et $end_date
        $city = ucfirst($_POST['city']);
        // $start_date = $_POST['start_date'];
        // $end_date = $_POST['end_date'];
        // $number_of_person = 2;
        $modelEnvie = new SearchModel;
        $datas = $modelEnvie->getLogementsByVille($city); 
        $villeInfo = $$modelEnvie->getVilleInfo($city);
    }
   
    $twig = $this->getTwig();

    if (isset($_POST['check'])) {

        $resultSearchView = $twig->render('resultsearch.html.twig', []);
        echo $resultSearchView;

        if (empty($datas)) {
            echo "Aucun logement ne correspond à votre recherche.";
        }
    } elseif (isset($_POST['id_logement'])) {
        $oneLogementView = $twig->render('resultsearch.html.twig', [
            'datas' => $datas,
            'villeInfo' => $villeInfo, ]);
        echo $oneLogementView;

    }
}

public function showLogementsByVille($city)
{
    $logements = new SearchModel;
    $logement = $logements->getLogementsByVille($city);
    $villeInfo = $logements->getVilleInfo($city);
    $twig = $this->getTwig();
    $oneLogementCity = $twig->render('resultsearch.html.twig', [
        'logements' => $logements,
        'villeInfo' => $villeInfo,
    ]);

    // Renvoyer la vue
    echo $oneLogementCity;
}

          


}