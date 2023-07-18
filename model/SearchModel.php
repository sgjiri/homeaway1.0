<?php

class SearchModel extends Model
{
    public function getSearch($city, $start_date, $end_date, $number_of_person)
    {
        $logementDispo = [];

        $stmt = $this->getDb()->prepare("SELECT DISTINCT  `logement`.`id_logement`, `title`, `city`,`resume`,`latitude`,`longitude`,`price_by_night`
    FROM `logement`
   
    LEFT JOIN `book` ON `logement`.id_logement = `book`.logement_id
    WHERE `logement`.city = :city
    AND `logement`.number_of_person >= :number_of_person
    AND (
        (`book`.`start_date` IS NULL AND `book`.`end_date` IS NULL)
        OR (`book`.`start_date` > :end_date OR `book`.`end_date` < :start_date)
        OR (`book`.`start_date` > :start_date AND `book`.`end_date` < :end_date)
        OR (:start_date > `book`.`start_date` AND :end_date < `book`.`end_date`)
    )");

        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindParam(':number_of_person', $number_of_person, PDO::PARAM_INT);
        $stmt->execute();
        
        // Récupérer les résultats de la requête
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($city);
        $length = (count($results));
       

        $newResult = [];

        foreach ($results as $logement) {
            $stmt2 = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId ");
            $stmt2->bindParam(':logementId',$logement['id_logement'],PDO::PARAM_STR);
            $stmt2 -> execute();
            $images =  $stmt2->fetchAll(PDO::FETCH_ASSOC);
           
            $logement['thumbnails'] = $images;
            $newResult[]= $logement;
        }
     
        return $newResult;
    }
}