<?php
class DashboardModel extends Model{
    public function getUser($idUser){
        $reqUser = $this->getDb()->prepare('SELECT `name`,`firstname`,`date_of_birth`,`password`,`phone_number`,`mail` FROM `person` WHERE `id_person` = :idUser');
        $reqUser->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $reqUser->execute();
        $User = $reqUser->fetch(PDO::FETCH_ASSOC);
        var_dump($User);
        return $User;
    }   
}