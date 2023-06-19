<?php
class HomePageController extends Controller{
    public function homepage()
    {
        $model = new HomePageModel;
        $citiesBeach = $model->getCityBeach();
        $twig = $this->getTwig();
        echo $twig->render('homePage.html.twig', ['cityBeach' => $citiesBeach]);

    }
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }

    public function cityMountains(){
    $model = new HomePageModel;
    $citiesMountain = $model->getCityMountains();
    // var_dump($citiesMountain);

    $twig = $this->getTwig();
    echo $twig->render('homePage.html.twig', ['cityMountain' => $citiesMountain]);
     

}
}