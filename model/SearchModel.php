<?php

class SearchModel extends Model
{
    public function getSearch($searchResult)

    {
        $logements =[];

        $sql=$this->getDb()->query('SELECT l.* FROM `logement` l WHERE l.city = "Marseille" AND NOT EXISTS ( SELECT * FROM ` book` b WHERE b.`id_logement` = l.`id_logement` AND b.`start_date` <= DATE_ADD(CURDATE(), INTERVAL 5 DAY) AND b.`end_date` >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)' );
       
       
        while ($logement = $sql->fetch(PDO::FETCH_ASSOC)) {
            $logements[] = new Logement($logement);
        }

        return $logements;
    }
}
