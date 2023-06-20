<?php
class HomePageController extends Controller
{
    public function homepage()
    {
        $model = new HomePageModel;
        $citiesBeach = $model->getCityBeach();
        $cityMountain = $model->getCityMountains();
        $modelImg = new ImageModel;
        $images = $modelImg->getImg();
       
        $twig = $this->getTwig();
        echo $twig->render('homePage.html.twig', ['cityBeach' => $citiesBeach, 'cityMountain' => $cityMountain, 'images'=>$images]);
    }
    // -*-*-*-*METHOD FOOTER LEGAL NOTICE  -*-*-*-*//
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }
}
