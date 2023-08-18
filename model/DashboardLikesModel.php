<?php

class DashboardLikesModel extends Model{

    public function getLikes($idUser){
        $req=$this->getDb()->prepare(
            'SELECT `title`, `adress`, `image`.`thumbnail`, `number_of_beds`, `like`.`id_logement` FROM `logement`
            INNER JOIN `like` 
            ON `logement`.`id_logement` = `like`.`id_logement`
            INNER JOIN `image`
            ON `logement`.`id_logement` =`image`.`id_logement`
            WHERE `like`.`id_person` = :idUser
            GROUP BY `logement`.`id_logement`');
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->execute();
        $Likes = $req->fetchAll(PDO::FETCH_ASSOC);
        return $Likes;
    }

    public function deleteLike($idUser, $id_logement){
        $req=$this->getDb()->prepare("DELETE FROM `like` WHERE `id_logement` = :id_logement AND `id_person` = :idUser");
        $req->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $req->bindParam(':id_logement', $id_logement, PDO::PARAM_STR);
        $req->execute();

    }
}