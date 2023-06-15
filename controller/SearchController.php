<?php

class SearchController extends Controller{
public function searchLogement (){
    if($_POST){
        $searchResult = $_POST['search'];
        $model = new SearchModel();
        $datas = $model->getSearch($searchResult);
    }
    echo self::getRender('resultsearch.html.twig', []);
}
}