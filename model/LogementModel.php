<?php

// class LogementModel extends Model{
//  public function getLogement(){
//     $logements = [];

//     $req = $this->getDb()->prepare('SELECT `id_logement`,`title`,`type`,`description`,`surface`,`adress`, `city`,`price_by_night` FROM `logement` WHERE `id_logement` = :id');
//     $req->bindParam('id',$id_logement,PDO::PARAM_INT);
//     $req->execute();

//     $logement = new Logement($req->fetch(PDO::FETCH_ASSOC));
                 
   
//     return $logement;
   
//  }



// }