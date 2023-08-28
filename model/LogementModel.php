<?php

class LogementModel extends Model
{

    public function addFlat($id_person, $title, $type, $surface, $resume, $description, $adress, $adressCode, $city, $location,  $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi, $latitude, $longitude)

    {

        $req = $this->getDb()->prepare('INSERT INTO `logement` (`id_person`, `title`, `type`, `surface`,`resume`, `description`, `adress`, `adressCode`,`city`, `location`,  `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`,`latitude`, `longitude`) VALUES (:id_person, :title,:type, :surface, :resume, :description, :adress,:adressCode, :city, :location,   :price_by_night, :number_of_person, :number_of_beds, :parking, :wifi, :piscine, :animals, :kitchen, :garden, :tv, :climatisation, :camera, :home_textiles, :spa, :jacuzzi, :latitude, :longitude )');

        $req->bindParam(":id_person", $id_person, PDO::PARAM_INT);
        $req->bindParam(":title", $title, PDO::PARAM_STR);
        $req->bindParam(":type", $type, PDO::PARAM_STR);
        $req->bindParam(":surface", $surface, PDO::PARAM_INT);
        $req->bindParam(":resume", $resume, PDO::PARAM_STR);
        $req->bindParam(":description", $description, PDO::PARAM_STR);
        $req->bindParam(":adress", $adress, PDO::PARAM_STR);
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
        return $this->getDb()->lastInsertId();
    }


    public function getUpload($thumbnailDatas, $idLogement)
    {
        foreach ($thumbnailDatas as $thumbnailData) {
            $reqUpload = $this->getDb()->prepare("INSERT INTO `image` (`thumbnail`, `id_logement`) VALUES (:thumbnail, :id_logement)");
            $reqUpload->bindParam(':thumbnail', $thumbnailData['thumbnail'], PDO::PARAM_STR);
            $reqUpload->bindParam(':id_logement', $idLogement, PDO::PARAM_INT);
            $reqUpload->execute();
        }
    }


    public function getCity(int $id_ville)
    {
        $req = $this->getDb()->prepare('SELECT  `title`,`id_city`,`number_of_person` FROM `logement` WHERE `id_city`= :id_ville');
        $req->bindParam('id_ville', $id_ville, PDO::PARAM_INT);
        $req->execute();

        $logements = new Logement($req->fetch(PDO::FETCH_ASSOC));

        return $logements;
    }

    // *-*-*-*-AFFICHAGE UN SEUL LOGEMENT *-*-*-*-//

    public function getOne(int $id_logement)
    {
        $req = $this->getDb()->prepare('SELECT * FROM `logement` WHERE `id_logement`= :id_logement');
        $req->bindParam('id_logement', $id_logement, PDO::PARAM_STR);
        $req->execute();

        $onelogement = new Logement($req->fetch(PDO::FETCH_ASSOC));
        return $onelogement;
    }

    public function getAllImg($id_logement)
    {
        $allImg = [];
        $reqAllImg = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId ");
        $reqAllImg->bindParam(':logementId', $id_logement, PDO::PARAM_STR);
        $reqAllImg->execute();
        // Utilisez fetchAll pour obtenir toutes les lignes résultantes
        $allImages = $reqAllImg->fetchAll(PDO::FETCH_ASSOC);

        // Parcourez les résultats et créez les objets Logement
        foreach ($allImages as $oneImg) {
            $allImg[] = new Image($oneImg);
        }
        return $allImg;
    }



    // -*-*-*-*-DELETE LOGEMENT-*-*-*-*

    public function delete(int $id_logement)
    {
        $reqDelete = $this->getDb()->prepare('DELETE FROM `logement` WHERE `id_logement` = :id_logement');

        $reqDelete->bindParam('id_logement', $id_logement, PDO::PARAM_INT);

        $reqDelete->execute();
    }

    
   
    public function favorite($id_logement, $id_person) {
        $reqAddFavorite = $this->getDb()->prepare("INSERT INTO `like` (`id_person`, `id_logement`) VALUES (:id_person, :id_logement)");
            
            $reqAddFavorite->bindValue(':id_person', $id_person, PDO::PARAM_INT);
            $reqAddFavorite->bindValue(':id_logement', $id_logement, PDO::PARAM_INT);
            $reqAddFavorite->execute();
         
    }
    public function delFavorite($id_person, $id_logement){
        $req=$this->getDb()->prepare("DELETE FROM `like` WHERE `id_logement` = :id_logement AND `id_person` = :id_person");
        $req->bindParam(':id_person', $id_person, PDO::PARAM_INT);
        $req->bindParam(':id_logement', $id_logement, PDO::PARAM_INT);
        $req->execute();

    }
    public function like($id_person)
    {
        $reqlike = $this->getDb()->prepare("SELECT `id_logement` FROM `like` WHERE id_person=:id_person");
        $reqlike->bindParam(':id_person', $id_person, PDO::PARAM_INT);
       
        $reqlike->execute();
        
        return $reqlike->fetchAll(PDO::FETCH_COLUMN);
    }
}