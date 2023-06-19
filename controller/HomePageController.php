<?php
class HomePageController extends Controller
{
    public function homepage()
    {
        $model = new HomePageModel;
        $citiesBeach = $model->getCityBeach();
        $cityMountain = $model->getCityMountains();
        // var_dump($citiesBeach);
        $twig = $this->getTwig();
        echo $twig->render('homePage.html.twig', ['cityBeach' => $citiesBeach, 'cityMountain' => $cityMountain]);
    }
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }
}
