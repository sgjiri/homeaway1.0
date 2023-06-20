<?php
class ImageModel extends Model {
    public function getImg()
    {
    $req = $this->getDb()->query("SELECT`id_image`,`thumbnail`,`logement_id`, `logement`.`type` FROM `image`
    INNER JOIN `logement` 
    ON `image`.`logement_id` = `logement`.`id_logement`");
    $images = $req->fetchAll(PDO::FETCH_ASSOC);
    return $images;
    }
    
}