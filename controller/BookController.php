<?php
class BookController extends Controller
{

    
    public function getReservation()

    {
        global $router;
        if (isset($_POST['submit'])) {
            // var_dump($_POST);

            if (isset($_SESSION['id_person'])) {
                $id_person = $_SESSION['id_person'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $id_logement = $_POST['id_logement'];
                  var_dump($_POST);

                $reservation = new BookModel();
                $resultReserve = $reservation->createReservation($start_date, $end_date, $id_person, $id_logement);

                if ($resultReserve) {
                    echo "Réservation effectuée avec succès.";
                    header('Location: ' . $router->generate('dashboard'));
                    exit();
                } else {
                    echo "Erreur lors de la réservation.";
                }
            }
        }
    }

    
}
