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

}