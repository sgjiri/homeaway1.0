<?php
class Book
{
    private $id_reservation;
    private $start_date;
    private $end_date;
    private $firstname;
    private $person_id2;
    private $logement_id;



    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    private function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    // *******************************************************GETTERS ET SETTERS***************************************************//

    // -*-*-*-*-*-*-*-GETTERS-*-*-*-*-*-*-*-*-//


    public function getIdReservation()
    {
        return $this->id_reservation;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getPersonId2()
    {
        return $this->person_id2;
    }

    public function getLogementId()
    {
        return $this->logement_id;
    }

    // -*-*-*-*-*-*-SETTERS-*-*-*-*-*-*-//


    public function setIdReservation(INT $id_reservation)
    {
        $this->id_reservation = $id_reservation;
    }

    public function setStartDate(STRING $start_date)
    {
        $this->start_date = $start_date;
    }

    public function setEndDate(STRING $end_date)
    {
        $this->end_date = $end_date;
    }

    public function setFirstname(STRING $firstname)
    {
        $this->firstname = $firstname;
    }

    public function setPersonId2(INT $person_id2)
    {
        $this->person_id2 = $person_id2;
    }

    public function setLogementId(INT $logement_id)
    {
        $this->logement_id = $logement_id;
    }


}