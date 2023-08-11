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

    public function createReservation($start_date, $end_date, $person_id2, $logement_id)
    {
       
        $reqReserve = $this->getDb()->prepare("INSERT INTO `book`( `start_date`, `end_date`, `person_id2`, `logement_id`) VALUES (:start_date, :end_date, :person_id2, :logement_id)");
        $reqReserve->bindParam(":start_date", $start_date,PDO::PARAM_STR);
        $reqReserve->bindParam(":end_date", $end_date,PDO::PARAM_STR);
        $reqReserve->bindParam(":person_id2", $person_id2,PDO::PARAM_INT);
        $reqReserve->bindParam(":logement_id", $logement_id,PDO::PARAM_INT);
       
        $resultReservation = $reqReserve->execute();
        return $resultReservation;
       
    }

    }
