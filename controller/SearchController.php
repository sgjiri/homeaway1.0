<?php

class SearchController extends Controller{
public function searchLogement (){
    if($_POST){
        $searchResult = $_POST['submit'];
        $model = new SearchModel();
        $datas = $model->getSearch($searchResult);
    }
    $twig = $this->getTwig();
    echo $twig->render('resultsearch.html.twig', []);
}



}