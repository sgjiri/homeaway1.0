<?php
abstract class Controller{
    private static $loader;
    private static $twig;
    

    private static function getLoader(){
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig(){
        if (self::$twig === null) {
            $loader = self::getLoader();
            self::$twig = new \Twig\Environment($loader);
            self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('get', $_GET);
            
    
            // Add the path function to Twig environment
            self::$twig->addFunction(new \Twig\TwigFunction('path', function ($routeName) {
                global $router;
                return $router->generate($routeName);
            }));
    
            // Add the asset function to Twig environment
            self::$twig->addFunction(new \Twig\TwigFunction('asset', function ($assetPath) {
                // Modify this logic according to your asset setup
                $basePath = '/Projet/homeaway1.0/asset'; // Update with your base asset path
                return $basePath . $assetPath;
            }));
        }
        return self::$twig;
    }
    

    
}