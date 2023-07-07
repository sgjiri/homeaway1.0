<?php
class ImageModel extends Model {
    public function getImg()
    {
        
    $req = $this->getDb()->query("SELECT`id_image`,`thumbnail`,`image`.`id_logement`, `logement`.`type` FROM `image`
    INNER JOIN `logement` 
    ON `image`.`id_logement` = `logement`.`id_logement` WHERE `type`= 'Cabane' " );
    $images = $req->fetch(PDO::FETCH_ASSOC);
    return $images;
    }

    public function getImgDome()
    {
        
    $reqDome = $this->getDb()->query("SELECT`id_image`,`thumbnail`,`image`.`id_logement`, `logement`.`type` FROM `image`
    INNER JOIN `logement` 
    ON `image`.`id_logement` = `logement`.`id_logement` WHERE `type`= 'Dôme'  " );
    $imagesDome = $reqDome->fetch(PDO::FETCH_ASSOC);
    return $imagesDome;
    }

    public function getImgPeniche()
    {
        
    $reqPeniche = $this->getDb()->query("SELECT`id_image`,`thumbnail`,`image`.`id_logement`, `logement`.`type` FROM `image`
    INNER JOIN `logement` 
    ON `image`.`id_logement` = `logement`.`id_logement` WHERE `type`= 'Peniche' " );
    $imagesPeniche = $reqPeniche->fetch(PDO::FETCH_ASSOC);
    return $imagesPeniche;
    }
    

    public function getImgYourte()
    {
        
    $reqYourte = $this->getDb()->query("SELECT`id_image`,`thumbnail`,`image`.`id_logement`, `logement`.`type` FROM `image`
    INNER JOIN `logement` 
    ON `image`.`id_logement` = `logement`.`id_logement` WHERE `type`= 'Yourte'  " );
    $imagesYourte = $reqYourte->fetch(PDO::FETCH_ASSOC);
    return $imagesYourte;
    }
}