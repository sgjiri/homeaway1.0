<?php

class LogementModel extends Model
{

    public function addFlat(logement $logement)
    {
       
       
        $req = $this->getDb()->prepare('INSERT INTO `logement` (`id_person`, `title`, `type`, `surface`, `description`, `adress`, `city`, `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`) VALUES (:id_person, :title,:type, :surface, :description, :adress, :city, :price_by_night, :number_of_person, :number_of_beds, :parking, :wifi, :piscine, :animals, :kitchen, :garden, :tv, :climatisation, :camera, :home_textiles, :spa, :jacuzzi');


        
         $req->bindParam(":id_person", $logement->getId_person(), PDO::PARAM_INT);
        $req->bindParam(":title", $logement->getTitle(), PDO::PARAM_STR);
        $req->bindParam(":type", $logement->getType(), PDO::PARAM_STR);
        $req->bindParam(":surface", $logement->getSurface(), PDO::PARAM_INT);
        $req->bindParam(":description", $logement->getDescription(), PDO::PARAM_STR);
        $req->bindParam(":adress", $logement->getAdress(), PDO::PARAM_STR);
        $req->bindParam(":city", $logement->getCity(), PDO::PARAM_STR);
        $req->bindParam(":price_by_night", $logement->getPrice_by_night(), PDO::PARAM_INT);
        $req->bindParam(":number_of_person", $logement->getNumber_of_person(), PDO::PARAM_INT);
        $req->bindParam(":number_of_beds", $logement->getNumber_of_beds(), PDO::PARAM_INT);
        $req->bindParam(":parking", $logement->getParking(), PDO::PARAM_BOOL);
        $req->bindParam(":wifi", $logement->getWifi(), PDO::PARAM_BOOL);
        $req->bindParam(":piscine", $logement->getPiscine(), PDO::PARAM_BOOL);
        $req->bindParam(":animals", $logement->getAnimals(), PDO::PARAM_BOOL);
        $req->bindParam(":kitchen", $logement->getKitchen(), PDO::PARAM_BOOL);
        $req->bindParam(":garden", $logement->getGarden(), PDO::PARAM_BOOL);
        $req->bindParam(":tv", $logement->getTv(), PDO::PARAM_BOOL);
        $req->bindParam(":climatisation", $logement->getClimatisation(), PDO::PARAM_BOOL);
        $req->bindParam(":camera", $logement->getCamera(), PDO::PARAM_BOOL);
        $req->bindParam(":home_textiles", $logement->getHome_textiles(), PDO::PARAM_BOOL);
        $req->bindParam(":spa", $logement->getSpa(), PDO::PARAM_BOOL);
        $req->bindParam(":jacuzzi", $logement->getJacuzzi(), PDO::PARAM_BOOL);

        $req->execute();
    }
}
      

    // public function addImage($id_logement, $thumbnail)
    // {
      
    //     $req = $this->getDb()->prepare("INSERT INTO image (id_logement, thumbnail) VALUES (:id_logement, :thumbnail)");
    //     $req->bindParam(":id_logement", $id_logement,PDO::PARAM_INT );
    //     $req->bindParam(":thumbnail", $thumbnail,PDO::PARAM_STR );
    //     $req->execute();
       
    // }

