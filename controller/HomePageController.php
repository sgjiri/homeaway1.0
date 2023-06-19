<?php
class HomePageController extends Controller
{
    public function homepage()
    {
        $model = new HomePageModel;
        $citiesBeach = $model->getCityBeach();
        $cityMountain = $model->getCityMountains();
        $cityUnusual = $model->getCityUnusual();
        $twig = $this->getTwig();
        echo $twig->render('homePage.html.twig', ['cityBeach' => $citiesBeach, 'cityMountain' => $cityMountain, 'cityUnusual'=>$cityUnusual]);
    }
    // -*-*-*-*METHOD FOOTER LEGAL NOTICE  -*-*-*-*//
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }
}
