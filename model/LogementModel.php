<?php

class LogementModel extends Model
{


  
    public function addFlat($id_person, $title, $type, $surface, $description, $adress, $adressCode,$city, $location,  $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi,$latitude, $longitude)
    {


        $req = $this->getDb()->prepare('INSERT INTO `logement` (`id_person`, `title`, `type`, `surface`, `description`, `adress`, `adressCode`,`city`, `location`,  `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`,`latitude`, `longitude`) VALUES (:id_person, :title,:type, :surface, :description, :adress,:adressCode, :city, :location,   :price_by_night, :number_of_person, :number_of_beds, :parking, :wifi, :piscine, :animals, :kitchen, :garden, :tv, :climatisation, :camera, :home_textiles, :spa, :jacuzzi, :latitude, :longitude )');

  
  



        $req->bindParam(":id_person", $id_person, PDO::PARAM_INT);
        $req->bindParam(":title", $title, PDO::PARAM_STR);
        $req->bindParam(":type", $type, PDO::PARAM_STR);

        $req->bindParam(":surface", $surface, PDO::PARAM_INT);      
        $req->bindParam(":description", $description, PDO::PARAM_STR); $req->bindParam(":adress", $adress, PDO::PARAM_STR); 
        $req->bindParam(":adressCode", $adressCode, PDO::PARAM_STR);
        
        $req->bindParam(":city", $city, PDO::PARAM_STR);
        $req->bindParam(":location", $location, PDO::PARAM_STR);
        $req->bindParam(":latitude", $latitude, PDO::PARAM_STR);
       

        $req->bindParam(":number_of_person", $number_of_person, PDO::PARAM_INT);
        $req->bindParam(":number_of_beds", $number_of_beds, PDO::PARAM_INT);
        $req->bindParam(":parking", $parking, PDO::PARAM_BOOL);
        $req->bindParam(":wifi", $wifi, PDO::PARAM_BOOL);
        $req->bindParam(":piscine", $piscine, PDO::PARAM_BOOL);
        $req->bindParam(":animals", $animals, PDO::PARAM_BOOL);
        $req->bindParam(":kitchen", $kitchen, PDO::PARAM_BOOL);
        $req->bindParam(":garden", $garden, PDO::PARAM_BOOL);
        $req->bindParam(":tv", $tv, PDO::PARAM_BOOL);
        $req->bindParam(":climatisation", $climatisation, PDO::PARAM_BOOL);
        $req->bindParam(":camera", $camera, PDO::PARAM_BOOL);
        $req->bindParam(":home_textiles", $home_textiles, PDO::PARAM_BOOL);
        $req->bindParam(":spa", $spa, PDO::PARAM_BOOL);
        $req->bindParam(":jacuzzi", $jacuzzi, PDO::PARAM_BOOL);
         $req->bindParam(":longitude", $longitude, PDO::PARAM_STR);
        
        $req->bindParam(":price_by_night", $price_by_night, PDO::PARAM_INT);

        $req->execute();
       
    }


      


    public function getCity(int $id_ville){
        $req = $this->getDb()->prepare('SELECT  `title`,`id_city`,`number_of_person` FROM `logement` WHERE `id_city`= :id_ville');
        $req->bindParam('id_ville',$id_ville,PDO::PARAM_INT);
        $req->execute();

        $logements = new Logement($req->fetch(PDO::FETCH_ASSOC));

        return $logements;
    }

    public function getAll()
    {
        $logements = [];

        $req = $this->getDb()->prepare('SELECT `title`,`id_city`,`number_of_person` FROM `logement` ORDER BY `id_city` DESC');
            
        while ($all = $req->fetch(PDO::FETCH_ASSOC)) {
            $logements[] = new Logement($all);
        }
        return $logements;
        
        }
        
        // public function addPosition($latitude, $longitude) {
            
        //     $reqPosition=$this->getDb()->query("INSERT INTO logement (latitude, longitude) VALUES ('$latitude', '$longitude')");
        //     $reqPosition->execute();

        // }
    
}


