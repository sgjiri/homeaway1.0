<?php
class DashboardReservationModel extends Model{


    public function getReservation($idUser){
        
        $req=$this->getDb()->prepare("SELECT `title`, `book`.`start_date`, `book`.`end_date`, `image`.`thumbnail` FROM `logement`
        INNER JOIN `image`
        ON `logement`.`id_logement` =`image`.`id_logement`
        INNER JOIN `book`
        ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person`
        ON `book`.`id_person` = `person`.`id_person`
        WHERE `person`.`id_person` = :idUser
        GROUP BY `id_reservation`");

        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->execute();
        $reqResevation = $req->fetchAll(PDO::FETCH_ASSOC);
        return $reqResevation;

    }




    public function getReservationChezMoi($idUser){
        $req=$this->getDb()->prepare("SELECT `title`, 
        GROUP_CONCAT(DISTINCT `person`.`mail`) AS `contact`, 
        GROUP_CONCAT(DISTINCT `book`.`start_date`) AS `start_date`,
        GROUP_CONCAT(DISTINCT `book`.`end_date`) AS `end_date`,
        GROUP_CONCAT(DISTINCT `person`.`name`) AS `name`, 
        GROUP_CONCAT(DISTINCT `person`.`firstname`) AS `firstname`
        FROM `logement`
        INNER JOIN `book` ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person` ON `book`.`id_person` = `person`.`id_person`
        WHERE `logement`.`id_person`= :idUser
        GROUP BY `title`
        ORDER BY `book`.`end_date`");
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->execute();
        $ReservationChezMoi= $req->fetchAll(PDO::FETCH_ASSOC);
        return $ReservationChezMoi;



    }
}