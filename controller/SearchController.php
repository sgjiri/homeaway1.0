<?php

class SearchController extends Controller{
public function searchLogement (){
    if($_POST){
        $searchResult = $_POST['search'];
        $model = new SearchModel();
        $datas = $model->getSearch($searchResult);
    }
    echo self::getRender('templateDashboard.html.twig', []);
}
}