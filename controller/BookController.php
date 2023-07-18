<?php
class BookController extends Controller {
  
public function getCompletCalendar(){
    $model = new BookModel();
    $id_logment=$_POST['id_logment'];

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

}
