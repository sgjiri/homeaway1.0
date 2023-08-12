<?php

class SearchModel extends Model
{

    public function getSearch($city, $start_date, $end_date, $number_of_person)
    {
        $logements = [];

        $stmt = $this->getDb()->prepare("
            SELECT DISTINCT *
            FROM `logement`
            LEFT JOIN `book` ON `logement`.id_logement = `book`.id_logement
            WHERE `logement`.city = :city
            AND `logement`.number_of_person >= :number_of_person
            AND (
                (`book`.`start_date` IS NULL AND `book`.`end_date` IS NULL)
                OR (`book`.`start_date` >:end_date OR `book`.`end_date` < :start_date)
                OR (`book`.`start_date` > :start_date AND `book`.`end_date` < :end_date)
                OR (:start_date > `book`.`start_date` AND :end_date < `book`.`end_date`)
                OR (
                    (:start_date = CURDATE() AND `book`.`start_date` = CURDATE() AND `book`.`end_date` = DATE_ADD(CURDATE(), INTERVAL 4 DAY))
                    OR (`book`.`start_date` <= :start_date AND `book`.`end_date` >= DATE_ADD(:start_date, INTERVAL 4 DAY))
                )
            )
        ");

        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':number_of_person', $number_of_person, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $length = count($results);

        foreach ($results as $logement) {
            $stmt2 = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId");
            $stmt2->bindParam(':logementId', $logement['id_logement'], PDO::PARAM_STR);
            $stmt2->execute();
            $images = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $logement['thumbnails'] = $images;
            $logements[] = $logement;
        }

        return $logements;
    }


    public function searchAccommodations($city, $start_date, $end_date, $number_of_person, $arrayFilter)
    {
        $logements = [];
        $reqFilter = "
        SELECT DISTINCT *
        FROM logement
        LEFT JOIN `book` ON `logement`.id_logement = `book`.id_logement
        WHERE `logement`.city = ?
        AND `logement`.number_of_person >= ?
        AND (
            (`book`.`start_date` IS NULL AND `book`.`end_date` IS NULL)
            OR (`book`.`start_date` > ? OR `book`.`end_date` < ?)
            OR (`book`.`start_date` > ? AND `book`.`end_date` < ?)
            OR (`book`.`start_date` < ? AND `book`.`end_date` > ?)
            OR (
                (CURDATE() = ? AND `book`.`start_date` = CURDATE() AND `book`.`end_date` = DATE_ADD(CURDATE(), INTERVAL 4 DAY))
                OR (`book`.`start_date` <= ? AND `book`.`end_date` >= DATE_ADD(?, INTERVAL 4 DAY))
            )
        )
        ";

        $param = [$city, $number_of_person, $start_date, $end_date, $start_date, $end_date, $start_date, $end_date, $start_date, $end_date, $start_date];


        foreach ($arrayFilter as $key => $value) {
            $reqFilter .= "AND $key = ?";
            $param[] = $value;
        }

        $stmt = $this->getDb()->prepare($reqFilter);

        $stmt->execute($param);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($stmt);


        foreach ($results as $logement) {
            $stmt2 = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId");
            $stmt2->bindParam(':logementId', $logement['id_logement'], PDO::PARAM_STR);
            $stmt2->execute();
            $images = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $logement['thumbnails'] = $images;
            $logements[] = $logement;
        }

        return $logements;
    }

    public function getLogementsByVille($city, $number_of_person)
    {
        $logements = [];

        $stmt = $this->getDb()->prepare(
            "SELECT DISTINCT  `logement`.`id_logement`, `title`, `city`,`resume`,`latitude`,`longitude`,`price_by_night` 
            FROM `logement` 
            LEFT JOIN `book` ON `logement`.id_logement = `book`.id_logement
            WHERE `city` = :city 
            AND `number_of_person` >= :number_of_person 
            AND 
            NOT EXISTS (
            SELECT 1 
            FROM `book`
            WHERE `book`.`id_logement` = `logement`.`id_logement`
            AND `book`.`start_date` >= :start_date
            AND `book`.`end_date` <= DATE_ADD(:start_date, INTERVAL 4 DAY)
            )
            
            "
        );

        // -- -- Réservation sur 5 jours
        // -- (`book`.`start_date` = CURDATE() AND `book`.`end_date` = DATE_ADD(CURDATE(), INTERVAL 4 DAY))

        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':number_of_person', $number_of_person, PDO::PARAM_INT);
        $stmt->bindParam('start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($results);

        foreach ($results as $logement) {
            $stmt2 = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId");
            $stmt2->bindParam(':logementId', $logement['id_logement'], PDO::PARAM_STR);
            $stmt2->execute();
            $images = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $logement['thumbnails'] = $images;
            $logements[] = $logement;
        }

        return $logements;
    }


    public function getLogementsByType($type, $number_of_person)
    {
        $logementsType = [];

        $reqByType = $this->getDb()->prepare(
            "SELECT DISTINCT  `logement`.`id_logement`, `title`, `city`, `resume`, `latitude`, `longitude`, `price_by_night` 
        FROM `logement` 
        LEFT JOIN `book` ON `logement`.id_logement = `book`.id_logement
       
        WHERE (
             `logement`.type = :type)
        AND `number_of_person` >= :number_of_person 
        AND 
        NOT EXISTS (
            SELECT 1 
            FROM `book`
            WHERE `book`.`id_logement` = `logement`.`id_logement`
            AND `book`.`start_date` >= :start_date
            AND `book`.`end_date` <= DATE_ADD(:start_date, INTERVAL 4 DAY)
        )
    "
        );

        $reqByType->bindParam(':number_of_person', $number_of_person, PDO::PARAM_INT);
        $reqByType->bindParam(':type', $type, PDO::PARAM_STR);
        $reqByType->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $reqByType->execute();

        $results = $reqByType->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $logement) {
            $reqByTypes = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId");
            $reqByTypes->bindParam(':logementId', $logement['id_logement'], PDO::PARAM_INT);
            $reqByTypes->execute();
            $images = $reqByTypes->fetchAll(PDO::FETCH_ASSOC);

            $logement['thumbnails'] = $images;
            $logementsType[] = $logement;
        }

        return $logementsType;
    }
}
