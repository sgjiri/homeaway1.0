<?php
class ImageModel extends Model {
    public function getImg()
    {
    $req = $this->getDb()->query("SELECT `id_image`,`thumbnail`,`id_logement` FROM `image`; ");
    $images = $req->fetchAll(PDO::FETCH_ASSOC);
    return $images;
    }
    
}