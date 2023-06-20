<?php
class HomePageModel extends Model{
    
    // -*-*-*-*METHOD LOGEMENT BEACH -*-*-*-*//
    public function getCityBeach(){
        $cityBeach = [];
        $req = $this->getDb()->query("SELECT `ville_nom`, `id_ville`, `img` FROM `villes_france` WHERE `place` = 'plage' ORDER BY RAND() LIMIT 4");
        $req->execute();

        while($oneCityBeach = $req->fetch(PDO::FETCH_ASSOC)){
            $cityBeach[] = new City($oneCityBeach);
        }
        return $cityBeach;

    }
    // -*-*-*-*METHOD LOGEMENT MOUNTAIN -*-*-*-*//
    public function getCityMountains(){
        $cityMountain =  [];
        $req = $this->getDb()->query("SELECT `ville_nom`,`id_ville`,`img` FROM `villes_france` WHERE `place` = 'montagne' ORDER BY RAND() LIMIT 4");
        $req->execute();
        while ($oneCityMountain = $req->fetch(PDO::FETCH_ASSOC)){
            $cityMountain[] = new City($oneCityMountain);
        }
        return $cityMountain;
    }
    // -*-*-*-*METHOD LOGEMENT UNUSUAL -*-*-*-*//
    public function getCityUnusual(){
        $cityUnusual = [];
        $req = $this->getDb()->query("SELECT `logement`.`type`,`logement`.`id_logement`
        FROM `logement` 
        WHERE `logement`.`type`
        IN ('Peniche', 'Cabane', 'Yourte', 'Dome')");

        $req->execute();
        while ($oneCityUnusual = $req->fetch(PDO::FETCH_ASSOC)){
            $cityUnusual[] = new Logement($oneCityUnusual);
        }
        return $cityUnusual;
         
    }
}