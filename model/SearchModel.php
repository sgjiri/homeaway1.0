<?php

class SearchModel extends Model
{
    public function getSearch($searchResult)

    {
      
// Récupérer les valeurs du formulaire
$city = $_POST['city'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$number_of_person = $_POST['number_of_person'];



// Préparation et exécution de la requête
$stmt = $this->getDb()->prepare("SELECT logement.*
FROM logement
INNER JOIN villes_france ON logement.city = villes_france.ville_nom
LEFT JOIN book ON logement.id_logement = book.id_logement
WHERE villes_france.ville_nom = ?
AND logement.number_of_person >= ?
AND (
    (book.start_date IS NULL AND book.end_date IS NULL)
    OR (book.start_date > ? OR book.end_date < ?)
    OR (book.start_date > ? AND book.end_date < ?)
    OR (? > book.start_date AND ? < book.end_date)
)");
$stmt->execute([
    $city,
    $number_of_person,
    $end_date,
    $start_date,
    $end_date,
    $start_date,
    $start_date,
    $end_date
]);

// Récupérer les résultats de la requête
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Utilisez les résultats comme vous le souhaitez (par exemple, affichage des résultats)
foreach ($results as $row) {
    echo $row['title'] . "<br>";
    // Afficher les autres informations du logement
}

}
}