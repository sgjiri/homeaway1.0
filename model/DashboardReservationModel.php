<?php
class DashboardReservationModel extends Model
{


    public function getReservation($idUser, $date)
    {

        $req = $this->getDb()->prepare("SELECT `title`, `book`.`start_date`, `book`.`end_date`, `image`.`thumbnail`, `id_reservation` FROM `logement`
        INNER JOIN `image`
        ON `logement`.`id_logement` =`image`.`id_logement`
        INNER JOIN `book`
        ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person`
        ON `book`.`id_person` = `person`.`id_person`
        WHERE `person`.`id_person` = :idUser AND `start_date` >= :date AND `status` = 0
        GROUP BY `id_reservation`");

        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->execute();
        $reqResevation = $req->fetchAll(PDO::FETCH_ASSOC);
        return $reqResevation;
    }

    public function getHistoriqueReservation($idUser, $date)
    {

        $req = $this->getDb()->prepare("SELECT `title`, `book`.`start_date`, `book`.`end_date`, `image`.`thumbnail` FROM `logement`
        INNER JOIN `image`
        ON `logement`.`id_logement` =`image`.`id_logement`
        INNER JOIN `book`
        ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person`
        ON `book`.`id_person` = `person`.`id_person`
        WHERE `person`.`id_person` = :idUser AND `start_date` <= :date 
        GROUP BY `id_reservation`");

        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->execute();
        $reqResevation = $req->fetchAll(PDO::FETCH_ASSOC);
        return $reqResevation;
    }

    public function getReservationChezMoi($idUser, $date)
    {
        $req = $this->getDb()->prepare("SELECT `title`, 
        GROUP_CONCAT(DISTINCT `person`.`mail`) AS `contact`, 
        GROUP_CONCAT(DISTINCT `book`.`start_date`) AS `start_date`,
        GROUP_CONCAT(DISTINCT `book`.`end_date`) AS `end_date`,
        GROUP_CONCAT(DISTINCT `person`.`name`) AS `name`, 
        GROUP_CONCAT(DISTINCT `person`.`firstname`) AS `firstname`
        FROM `logement`
        INNER JOIN `book` ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person` ON `book`.`id_person` = `person`.`id_person`
        WHERE `logement`.`id_person`= :idUser AND `start_date` >= :date 
        GROUP BY `title`
        ORDER BY `book`.`end_date`");
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->execute();
        $ReservationChezMoi = $req->fetchAll(PDO::FETCH_ASSOC);
        return $ReservationChezMoi;
    }



    public function getHistoriqueReservationChezMoi($idUser, $date)
    {
        $req = $this->getDb()->prepare("SELECT `title`, 
        GROUP_CONCAT(DISTINCT `person`.`mail`) AS `contact`, 
        GROUP_CONCAT(DISTINCT `book`.`start_date`) AS `start_date`,
        GROUP_CONCAT(DISTINCT `book`.`end_date`) AS `end_date`,
        GROUP_CONCAT(DISTINCT `person`.`name`) AS `name`, 
        GROUP_CONCAT(DISTINCT `person`.`firstname`) AS `firstname`
        FROM `logement`
        INNER JOIN `book` ON `logement`.`id_logement` = `book`.`id_logement`
        INNER JOIN `person` ON `book`.`id_person` = `person`.`id_person`
        WHERE `logement`.`id_person`= :idUser AND `start_date` <= :date 
        GROUP BY `title`
        ORDER BY `book`.`end_date`");
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->execute();
        $historiqueReservationChezMoi = $req->fetchAll(PDO::FETCH_ASSOC);
        return $historiqueReservationChezMoi;
    }

    public function selectDate($id_resevation){
        $reqDate=$this->getDb()->prepare("SELECT `start_date` FROM `book` WHERE `id_reservation` = :id_resevation");
        $reqDate->bindParam(':id_resevation', $id_resevation, PDO::PARAM_STR);
        $reqDate->execute();
        $startDate = $reqDate->fetch(PDO::FETCH_ASSOC);
        return $startDate;
        
    }

    public function deletResevation($id_resevation){
 
        $req=$this->getDb()->prepare("UPDATE `book`SET `status` = 1 WHERE `id_reservation` = :id_resevation");
        $req->bindParam(':id_resevation', $id_resevation, PDO::PARAM_STR);
        $req->bindParam(':id_resevation', $id_resevation, PDO::PARAM_STR);
        $req->execute();
    }
}
