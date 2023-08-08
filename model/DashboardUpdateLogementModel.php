<?php 
class DashboardUpdateLogementModel extends Model{
    public function getLogement($idUser){
        $reqLogement = $this->getDb()->prepare('SELECT * FROM `logement` WHERE `id_person` = :idUser');
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

        $updateType = $this->getDb()->prepare('UPDATE `logement` SET `surface` = :surface WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateType->bindParam(':surface', $surface, PDO::PARAM_STR);
        $updateType->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateType->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateType->execute();
    }

    public function setLocation($location, $idUser, $idLogement)
    {

        $updateType = $this->getDb()->prepare('UPDATE `logement` SET `location` = :location WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateType->bindParam(':location', $location, PDO::PARAM_STR);
        $updateType->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateType->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateType->execute();
    }

    public function setPrice($price_by_night, $idUser, $idLogement)
    {

        $updateType = $this->getDb()->prepare('UPDATE `logement` SET `price_by_night` = :price_by_night WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateType->bindParam(':price_by_night', $price_by_night, PDO::PARAM_STR);
        $updateType->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateType->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateType->execute();
    }

    public function setPersone($number_of_person, $idUser, $idLogement)
    {

        $updateType = $this->getDb()->prepare('UPDATE `logement` SET `number_of_person` = :number_of_person WHERE `id_person` = :userId AND `id_logement`= :idLogement');
        $updateType->bindParam(':number_of_person', $number_of_person, PDO::PARAM_STR);
        $updateType->bindParam(':userId', $idUser, PDO::PARAM_STR);
        $updateType->bindParam(':idLogement', $idLogement, PDO::PARAM_STR);
        return $updateType->execute();
    }
}