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
}