<?php

class SearchController extends Controller
{

    public function searchLogement()
    {
<<<<<<< HEAD
        // if (isset($_POST['id_logement'])){
        //     echo('patate');
        // }

        if (isset($_POST['submit']) || isset($_POST['id_logement'])) {
=======

        if (isset($_POST['submit'])) {
>>>>>>> 30262acd445b418eaa30611adb0b950a82a3fe12
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
<<<<<<< HEAD
      
        if (isset($_POST['check'])) {
=======

        if ($_POST['check']=true) {
>>>>>>> 30262acd445b418eaa30611adb0b950a82a3fe12

            $resultSearchView = $twig->render('resultsearch.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $resultSearchView;

            if (empty($datas)) {
                echo "Aucun logement ne correspond à votre recherche.";
            }
<<<<<<< HEAD
=======
        } else {
            $oneLogementView = $twig->render('oneLogement.html.twig', [
                'logementDispo' => $datas,
                'totalPrices' => $totalPrices,
                'formValue' => $formValue
            ]);
            echo $oneLogementView;

>>>>>>> 30262acd445b418eaa30611adb0b950a82a3fe12
        }
        //  elseif (isset($_POST['id_logement'])) {
           
           
        //     $oneLogementView = $twig->render('oneLogement.html.twig', [
        //         'logementDispo' => $datas,
        //         'totalPrices' => $totalPrices,
        //         'formValue' => $formValue
        //     ]);
        //     echo $oneLogementView;
        // }
    }
}
