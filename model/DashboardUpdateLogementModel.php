<?php 
class DashboardUpdateLogementModel extends Model{
    public function getLogement($idUser){
        $reqLogement = $this->getDb()->prepare('SELECT * FROM `logement` WHERE `id_person` = :idUser');
        $reqLogement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $reqLogement->execute();
        $Logement = $reqLogement->fetch(PDO::FETCH_ASSOC);
        var_dump($Logement);

    }
}