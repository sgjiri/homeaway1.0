<?php

class BookModel extends Model {
    public function getBookHold($id_logment) {
        
        $reqbook = $this->getDb()->prepare("SELECT * FROM book WHERE logement_id = :id_logment");
        $reqbook->bindParam(":id_logment", $id_logment, PDO::PARAM_INT);
        $reqbook->execute(array(':id_logment' => $id_logment));

        $books = array();

        while ($row = $reqbook->fetch(PDO::FETCH_ASSOC)) {
            $book = array();
            $book['title'] = 'Réservation existante';
            $book['start_date'] = $row['start_date'];
            $book['end_date'] = $row['end_date'];
            $book['color'] = 'red';
            $books[] = $book;
        }

        return $books;
    }
}