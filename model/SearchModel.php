<?php

class SearchModel extends Model
{
    public function getSearch($city, $start_date, $end_date, $number_of_person)
    {
        $logementDispo = [];

        $stmt = $this->getDb()->prepare("SELECT *
    FROM `logement`
    INNER JOIN `image` ON `logement`.id_logement = `image`.id_logement
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

        $length = (count($results));

        for($i=0; $i< $length; $i++){
            $logementDispo[$i] = [];
            array_push($logementDispo[$i], new Logement($results[$i]));
            array_push($logementDispo[$i], new Image($results[$i]));

        }
        return $logementDispo;
    }
}