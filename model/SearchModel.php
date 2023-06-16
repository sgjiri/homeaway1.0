<?php

class SearchModel extends Model
{
    public function getSearch($searchResult)

    {
        $logements =[];

        $sql=$this->getDb()->query(SELECT * FROM `book`
        WHERE ville = 'nom_de_la_ville'
          AND date_arrivee >= 'date_arrivee_recherchee'
          AND date_depart <= 'date_depart_recherchee'
          AND nombre_personnes >= 'nombre_personnes_recherche'
        ' );
       
       
        while ($logement = $sql->fetch(PDO::FETCH_ASSOC)) {
            $logements[] = new Logement($logement);
        }

        return $logements;
    }
}
