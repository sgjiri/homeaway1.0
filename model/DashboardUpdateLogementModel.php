<?php
class DashboardUpdateLogementModel extends Model
{
    public function getLogement($idUser)
    {
        $reqLogement = $this->getDb()->prepare('SELECT *, GROUP_CONCAT(DISTINCT `image`.`thumbnail` ORDER BY `image`.`id_logement`)  AS `images` FROM `logement` INNER JOIN `image`
        ON `logement`.`id_logement` =`image`.`id_logement`WHERE `id_person` = :idUser GROUP BY `logement`.`id_logement`');
        $reqLogement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $reqLogement->execute();
        $Logement = $reqLogement->fetchAll(PDO::FETCH_ASSOC);
        return $Logement;
    }
    public function setTitle($title, $idUser, $idLogement)
    {

        $updateTitle = $this->getDb()->prepare('UPDATE `logement` SET `title` = :title WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateTitle->bindParam(':title', $title, PDO::PARAM_STR);
        $updateTitle->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateTitle->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateTitle->execute();
    }

    public function setAdresse($adresse, $codePostale, $city, $idUser, $idLogement)
    {

        $updateTitle = $this->getDb()->prepare('UPDATE `logement` SET `adress` = :adress,`adressCode` = :adressCode,`city` = :city WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateTitle->bindParam(':adress', $adresse, PDO::PARAM_STR);
        $updateTitle->bindParam(':adressCode', $codePostale, PDO::PARAM_STR);
        $updateTitle->bindParam(':city', $city, PDO::PARAM_STR);
        $updateTitle->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateTitle->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateTitle->execute();
    }

    public function setType($type, $idUser, $idLogement)
    {

        $updateType = $this->getDb()->prepare('UPDATE `logement` SET `type` = :type WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateType->bindParam(':type', $type, PDO::PARAM_STR);
        $updateType->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateType->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateType->execute();
    }

    public function setSurface($surface, $idUser, $idLogement)
    {

        $updateSurface = $this->getDb()->prepare('UPDATE `logement` SET `surface` = :surface WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateSurface->bindParam(':surface', $surface, PDO::PARAM_STR);
        $updateSurface->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateSurface->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateSurface->execute();
    }

    public function setLocation($location, $idUser, $idLogement)
    {

        $updateLocation = $this->getDb()->prepare('UPDATE `logement` SET `location` = :location WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateLocation->bindParam(':location', $location, PDO::PARAM_STR);
        $updateLocation->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateLocation->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateLocation->execute();
    }

    public function setPrice($price_by_night, $idUser, $idLogement)
    {

        $updatePrice = $this->getDb()->prepare('UPDATE `logement` SET `price_by_night` = :price_by_night WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updatePrice->bindParam(':price_by_night', $price_by_night, PDO::PARAM_STR);
        $updatePrice->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updatePrice->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updatePrice->execute();
    }

    public function setPersone($number_of_person, $idUser, $idLogement)
    {

        $updatePersone = $this->getDb()->prepare('UPDATE `logement` SET `number_of_person` = :number_of_person WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updatePersone->bindParam(':number_of_person', $number_of_person, PDO::PARAM_STR);
        $updatePersone->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updatePersone->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updatePersone->execute();
    }

    public function setBeds($number_of_beds, $idUser, $idLogement)
    {

        $updateBeds = $this->getDb()->prepare('UPDATE `logement` SET `number_of_beds` = :number_of_beds WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateBeds->bindParam(':number_of_beds', $number_of_beds, PDO::PARAM_STR);
        $updateBeds->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateBeds->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateBeds->execute();
    }


    public function setDescription($description, $idUser, $idLogement)
    {

        $updateDescription = $this->getDb()->prepare('UPDATE `logement` SET `description` = :description WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateDescription->bindParam(':description', $description, PDO::PARAM_STR);
        $updateDescription->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateDescription->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateDescription->execute();
    }

    public function setResume($resume, $idUser, $idLogement)
    {

        $updateResumer = $this->getDb()->prepare('UPDATE `logement` SET `resume` = :resume WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateResumer->bindParam(':resume', $resume, PDO::PARAM_STR);
        $updateResumer->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateResumer->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateResumer->execute();
    }

    public function setEquipment($parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $idUser, $jacuzzi, $idLogement)
    {

        $updateEquipment = $this->getDb()->prepare('UPDATE `logement` SET `parking` = :parking, `wifi` = :wifi, `piscine` = :piscine, `animals` = :animals, `kitchen` = :kitchen, `garden` = :garden, `tv` = :tv, `climatisation` = :climatisation, `camera` = :camera, `home_textiles` = :home_textiles, `spa` = :spa, `jacuzzi` = :jacuzzi WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateEquipment->bindParam(":parking", $parking, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":wifi", $wifi, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":piscine", $piscine, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":animals", $animals, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":kitchen", $kitchen, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":garden", $garden, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":tv", $tv, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":climatisation", $climatisation, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":camera", $camera, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":home_textiles", $home_textiles, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":spa", $spa, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(":jacuzzi", $jacuzzi, PDO::PARAM_BOOL);
        $updateEquipment->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateEquipment->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateEquipment->execute();
    }

  public function deleteImg($suprimerImage)
    {
        $sql = "DELETE FROM `image` WHERE `image`.`thumbnail` IN (";

        for($i = 0; $i < count($suprimerImage); $i++){
            $sql .= ($i == 0) ? '?' : ',?';
        }
        
        $sql .= ")";

        $deleteImg = $this->getDb()->prepare($sql);
    
        return $deleteImg->execute($suprimerImage);
    }
}
