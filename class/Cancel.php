<?php
class Cancel
{
    private $id_cancel;
    private $id_reservation;
    private $cancellation_date;
    private $reason;


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

    // *********************************************GETTERS ET SETTERS ******************************************************//

    // -*-*-*-*-*-*-*-* GETTERS *-*-*-*-*-*-*-*-*//

    public function getIdCancel()
    {
        return $this->id_cancel;
    }

    public function getIdReservation()
    {
        return $this->id_reservation;
    }

    public function getCancellationDate()
    {
        return $this->cancellation_date;
    }

    public function getReason()
    {
        return $this->reason;
    }


    // -*-*-*-*-*-*-*-*-*-* SETTERS *-*-*-*-*-*-*-*-*-//


    public function setIdCancel(INT $id_cancel)
    {
        $this->id_cancel = $id_cancel;
      
    }

    public function setIdReservation(INT $id_reservation)
    {
        $this->id_reservation = $id_reservation;
      
    }

    public function setCancellationDate(STRING $cancellation_date)
    {
        $this->cancellation_date = $cancellation_date;
     
    }

    public function setReason(STRING $reason)
    {
        $this->reason = $reason;
     
    }
}
