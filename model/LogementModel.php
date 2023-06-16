<?php

class LogementModel extends Model
{

    public function addFlat($id_person, $title, $type, $surface, $description, $adress, $city, $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi)
    {
       
       
        $req = $this->getDb()->prepare('INSERT INTO `logement` (`id_person`, `title`, `type`, `surface`, `description`, `adress`, `city`, `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`) VALUES (:id_person, :title,:type, :surface, :description, :adress, :city, :price_by_night, :number_of_person, :number_of_beds, :parking, :wifi, :piscine, :animals, :kitchen, :garden, :tv, :climatisation, :camera, :home_textiles, :spa, :jacuzzi)');


        
        $req->bindParam(":id_person", $id_person, PDO::PARAM_INT);
        $req->bindParam(":title", $title, PDO::PARAM_STR);
        $req->bindParam(":type", $type, PDO::PARAM_STR);
        $req->bindParam(":surface", $surface, PDO::PARAM_INT);
        $req->bindParam(":description", $description, PDO::PARAM_STR);
        $req->bindParam(":adress", $adress, PDO::PARAM_STR);
        $req->bindParam(":city", $city, PDO::PARAM_STR);
        $req->bindParam(":price_by_night", $price_by_night, PDO::PARAM_INT);
        $req->bindParam(":number_of_person", $number_of_person, PDO::PARAM_INT);
        $req->bindParam(":number_of_beds", $number_of_beds, PDO::PARAM_INT);
        $req->bindParam(":parking", $parking, PDO::PARAM_BOOL);
        $req->bindParam(":wifi", $wifi, PDO::PARAM_BOOL);
        $req->bindParam(":piscine", $piscine, PDO::PARAM_BOOL);
        $req->bindParam(":animals", $animals, PDO::PARAM_BOOL);
        $req->bindParam(":kitchen", $kitchen, PDO::PARAM_BOOL);
        $req->bindParam(":garden", $garden, PDO::PARAM_BOOL);
        $req->bindParam(":tv", $tv, PDO::PARAM_BOOL);
        $req->bindParam(":climatisation", $climatisation, PDO::PARAM_BOOL);
        $req->bindParam(":camera", $camera, PDO::PARAM_BOOL);
        $req->bindParam(":home_textiles", $home_textiles, PDO::PARAM_BOOL);
        $req->bindParam(":spa", $spa, PDO::PARAM_BOOL);
        $req->bindParam(":jacuzzi", $jacuzzi, PDO::PARAM_BOOL);

        $req->execute();
    }


    // public function getAll($city,$start_date,$end_date,$number_of_person)
    // {
    //     $logements = [];
    //     $req = $this->getDb()->prepare('SELECT `title`, `description`, `price_by_night` FROM `logement` WHERE `city` = :city  
    //         AND  `start_date` >= :start_date
    //         AND `end_date` <= :end_date 
    //         AND `number_of_person` >= :number_of_person');
    //     $req->bindParam(":city", $city, PDO::PARAM_STR);
    //     $req->bindParam(":start_date", $start_date, PDO::PARAM_STR);
    //     $req->bindParam(":end_date", $end_date, PDO::PARAM_STR);
    //     $req->bindParam(":number_of_person", $number_of_person, PDO::PARAM_INT);
    //     $req->execute();
    //     while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    //         $logements[] = new Logement($row);
    //     }
    //     return $logements;
        
    public function getAll($city, $start_date, $end_date, $number_of_person)
{
    $logements = [];
    $req = $this->getDb()->prepare('SELECT logement.`title`, logement.`description`, logement.`price_by_night` 
                                   FROM `logement` 
                                   INNER JOIN `book` ON logement.`id_logement` = book.`id_logement`
                                   WHERE logement.`city` = :city  
                                   AND book.`start_date` >= :start_date
                                   AND book.`end_date` <= :end_date 
                                   AND logement.`number_of_person` >= :number_of_person');
    $req->bindParam(":city", $city, PDO::PARAM_STR);
    $req->bindParam(":start_date", $start_date, PDO::PARAM_STR);
    $req->bindParam(":end_date", $end_date, PDO::PARAM_STR);
    $req->bindParam(":number_of_person", $number_of_person, PDO::PARAM_INT);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $logements[] = new Logement($row['title'], $row['description'], $row['price_by_night']);
    }
    return $logements;
}

    
}




      

    

