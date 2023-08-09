<?php

class LogementModel extends Model
{

    public function addFlat($id_person, $title, $type, $surface, $resume, $description, $adress, $adressCode, $city, $location,  $price_by_night, $number_of_person, $number_of_beds, $parking, $wifi, $piscine, $animals, $kitchen, $garden, $tv, $climatisation, $camera, $home_textiles, $spa, $jacuzzi, $latitude, $longitude)

    {

        $req = $this->getDb()->prepare('INSERT INTO `logement` (`id_person`, `title`, `type`, `surface`,`resume`, `description`, `adress`, `adressCode`,`city`, `location`,  `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`,`latitude`, `longitude`) VALUES (:id_person, :title,:type, :surface, :resume, :description, :adress,:adressCode, :city, :location,   :price_by_night, :number_of_person, :number_of_beds, :parking, :wifi, :piscine, :animals, :kitchen, :garden, :tv, :climatisation, :camera, :home_textiles, :spa, :jacuzzi, :latitude, :longitude )');

        $req->bindParam(":id_person", $id_person, PDO::PARAM_INT);
        $req->bindParam(":title", $title, PDO::PARAM_STR);
        $req->bindParam(":type", $type, PDO::PARAM_STR);
        $req->bindParam(":surface", $surface, PDO::PARAM_INT);
        $req->bindParam(":resume", $resume, PDO::PARAM_STR);
        $req->bindParam(":description", $description, PDO::PARAM_STR);
        $req->bindParam(":adress", $adress, PDO::PARAM_STR);
        $req->bindParam(":adressCode", $adressCode, PDO::PARAM_STR);
        $req->bindParam(":city", $city, PDO::PARAM_STR);
        $req->bindParam(":location", $location, PDO::PARAM_STR);
        $req->bindParam(":latitude", $latitude, PDO::PARAM_STR);
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
        $req->bindParam(":longitude", $longitude, PDO::PARAM_STR);
        $req->bindParam(":price_by_night", $price_by_night, PDO::PARAM_INT);

        $req->execute();
        return $this->getDb()->lastInsertId();
    }


    public function getUpload($thumbnailDatas, $idLogement)
    {
        foreach ($thumbnailDatas as $thumbnailData) {
            $reqUpload = $this->getDb()->prepare("INSERT INTO `image` (`thumbnail`, `id_logement`) VALUES (:thumbnail, :id_logement)");
            $reqUpload->bindParam(':thumbnail', $thumbnailData['thumbnail'], PDO::PARAM_STR);
            $reqUpload->bindParam(':id_logement', $idLogement, PDO::PARAM_INT);
            $reqUpload->execute();
        }
    }


    public function getCity(int $id_ville)
    {
        $req = $this->getDb()->prepare('SELECT  `title`,`id_city`,`number_of_person` FROM `logement` WHERE `id_city`= :id_ville');
        $req->bindParam('id_ville', $id_ville, PDO::PARAM_INT);
        $req->execute();

        $logements = new Logement($req->fetch(PDO::FETCH_ASSOC));

        return $logements;
    }

    // *-*-*-*-AFFICHAGE UN SEUL LOGEMENT *-*-*-*-//

    public function getOne(int $id_logement)
    {
        $req = $this->getDb()->prepare('SELECT * FROM `logement` WHERE `id_logement`= :id_logement');
        $req->bindParam('id_logement', $id_logement, PDO::PARAM_STR);
        $req->execute();

        $onelogement = new Logement($req->fetch(PDO::FETCH_ASSOC));
        return $onelogement;
    }

    public function getAllImg($id_logement)
    {
        $allImg = [];
        $reqAllImg = $this->getDb()->prepare("SELECT * FROM `image` WHERE `id_logement` = :logementId ");
        $reqAllImg->bindParam(':logementId', $id_logement, PDO::PARAM_STR);
        $reqAllImg->execute();
        // Utilisez fetchAll pour obtenir toutes les lignes résultantes
        $allImages = $reqAllImg->fetchAll(PDO::FETCH_ASSOC);

        // Parcourez les résultats et créez les objets Logement
        foreach ($allImages as $oneImg) {
            $allImg[] = new Image($oneImg);
        }
        return $allImg;
    }



    // -*-*-*-*-DELETE LOGEMENT-*-*-*-*

    public function delete(int $id_logement)
    {
        $reqDelete = $this->getDb()->prepare('DELETE FROM `logement` WHERE `id_logement` = :id');

        $reqDelete->bindParam('id_logement', $id_logement, PDO::PARAM_INT);

        $reqDelete->execute();
    }

    // -*-*-*-*-*-FILTRES RECHERCHE-*-*-*-*-*
    public function logementFilters($selectedFilters)
    {

        // Sélectionne toutes les colonnes de la table logement avec une condition initiale WHERE 1, qui est toujours vraie.
        $reqFilter = "SELECT * FROM `logement` WHERE 1";
        // Initialisation de l'array pour les conditions et les paramètres de requête
        $conditions = [];
        $queryParams = [];

        // Vérifie si l'utilisateur a sélectionné le filtre wifi, et si oui, ajoute la condition au niveau de la requête SQL.
        if (isset($selectedFilters['wifi'])) {
            $conditions[] = "wifi = :wifi";
            $queryParams[':wifi'] = 1;
        }
        if (isset($selectedFilters['parking'])) {
            $conditions[] = "parking = :parking";
            $queryParams[':parking'] = 1;
        }
        if (isset($selectedFilters['piscine'])) {
            $conditions[] = "piscine = :piscine";
            $queryParams[':piscine'] = 1;
        }
        if (isset($selectedFilters['animals'])) {
            $conditions[] = "animals = :animals";
            $queryParams[':animals'] = 1;
        }
        if (isset($selectedFilters['kitchen'])) {
            $conditions[] = "kitchen = :kitchen";
            $queryParams[':kitchen'] = 1;
        }
        if (isset($selectedFilters['garden'])) {
            $conditions[] = "garden = :garden";
            $queryParams[':garden'] = 1;
        }
        if (isset($selectedFilters['tv'])) {
            $conditions[] = "tv = :tv";
            $queryParams[':tv'] = 1;
        }
        if (isset($selectedFilters['climatisation'])) {
            $conditions[] = "climatisation = :climatisation";
            $queryParams[':climatisation'] = 1;
        }
        if (isset($selectedFilters['camera'])) {
            $conditions[] = "camera = :camera";
            $queryParams[':camera'] = 1;
        }
        if (isset($selectedFilters['home_textiles'])) {
            $conditions[] = "home_textiles = :home_textiles";
            $queryParams[':home_textiles'] = 1;
        }
        if (isset($selectedFilters['spa'])) {
            $conditions[] = "spa = :spa";
            $queryParams[':spa'] = 1;
        }
        if (isset($selectedFilters['jacuzzi'])) {
            $conditions[] = "jacuzzi = :jacuzzi";
            $queryParams[':jacuzzi'] = 1;
        }



        if (!empty($conditions)) {
            $reqFilter .= " AND " . implode(" AND ", $conditions);
        }


        // Exécution de la requête préparée
        $stmtFiltre = $this->getDb()->prepare($reqFilter);
        $stmtFiltre->execute($queryParams);

        // Récupération des résultats
        $results = $stmtFiltre->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
