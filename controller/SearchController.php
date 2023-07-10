<?php

class SearchController extends Controller{
public function searchLogement (){
    if(isset($_POST['submit'])) {
        $city = $_POST['city'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $number_of_person = $_POST['number_of_person'];

        $model= new SearchModel;
        $datas = $model->getSearch($city,$start_date,$end_date, $number_of_person);
    }
    $twig = $this->getTwig();
    echo $twig->render('resultsearch.html.twig', ['logementDispo' => $datas]);
}}