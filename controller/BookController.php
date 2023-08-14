<?php
class BookController extends Controller
{

    public function getCompletCalendar()
    {
        $model = new BookModel();
        $id_logment = $_POST['id_logment'];

        if ($_GET['action'] == 'getReservations' && isset($_GET['id_logment'])) {
            $book = $model->getBookHold($id_logment)($_GET['id_logment']);
            header('Content-Type: application/json');
            echo json_encode($book);
        } else {
            // Afficher la vue par défaut
            $twig = $this->getTwig();
            echo $twig->render('oneLogement.html.twig', []);
        }
    }

    public function getReservation()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_person = $_SESSION['id_person'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $logement_id = $_POST['logement_id'];
        
        $reservation = new BookModel();
        $resultReserve = $reservation->createReservation($start_date, $end_date, $id_person, $logement_id);

        if ($resultReserve) {
            echo "Réservation effectuée avec succès.";
            header("Location: /Projet/homeaway1.0/dashboard?activeElement=contentMesReservation");
        } else {
            echo "Erreur lors de la réservation.";
        }
    }
}

    
}
