<?php

class BookModel extends Model {
    public function getBookHold($id_logment) {
          $books = [];
        $reqbook = $this->getDb()->prepare("SELECT `start_date`, `end_date` FROM book WHERE logement_id = :id_logment");
        $reqbook->bindParam(":id_logment", $id_logment, PDO::PARAM_INT);
        $reqbook->execute(array(':id_logment' => $id_logment));

        $books = array();

        while ($book = $reqbook->fetch(PDO::FETCH_ASSOC)) {
           $books[] = $book;
        }

        return $books;
    }
 


    public function createReservation($start_date, $end_date, $id_person, $logement_id)
    {
       
        $reqReserve = $this->getDb()->prepare("INSERT INTO `book`( `start_date`, `end_date`, `id_person`, `logement_id`) VALUES (:start_date, :end_date, :id_person, :logement_id)");

        $reqReserve->bindParam(":start_date", $start_date,PDO::PARAM_STR);
        $reqReserve->bindParam(":end_date", $end_date,PDO::PARAM_STR);
        $reqReserve->bindParam(":id_person", $id_person,PDO::PARAM_INT);
        $reqReserve->bindParam(":logement_id", $logement_id,PDO::PARAM_INT);
       
       return  $reqReserve->execute();
       
       
    }

    }
