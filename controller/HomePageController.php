<?php
class HomePageController extends Controller
{
    public function homepage()
    {
        $model = new HomePageModel;
        $citiesBeach = $model->getCityBeach();
        $cityMountain = $model->getCityMountains();
        $modelImg = new ImageModel;
        $modelImgDome = new ImageModel;
        $modelImgPeniche = new ImageModel;
        $modelImgYourte = new ImageModel;
        $images = $modelImg->getImg();
        $imagesDome = $modelImgDome->getImgDome();
        $imagesPeniche = $modelImgPeniche->getImgPeniche();
        $imagesYourte = $modelImgYourte->getImgYourte();
       

        $twig = $this->getTwig();
        echo $twig->render('homePage.html.twig', ['cityBeach' => $citiesBeach, 'cityMountain' => $cityMountain, 'imagesDome'=>$imagesDome,'imagesPeniche'=>$imagesPeniche,'images'=>$images,'imagesYourte'=>$imagesYourte]);
    }
    // -*-*-*-*METHOD FOOTER LEGAL NOTICE  -*-*-*-*//
    public function legalNotices()
    {
        $twig = $this->getTwig();
        echo $twig->render('legalNotices.html.twig', []);
    }
}
