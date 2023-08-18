<?php
class ContactController extends Controller{
    
        public function sendMail()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupération des données du formulaire
                $name = $_POST['name'];
                $mail = $_POST['mail'];
                $message = $_POST['message'];
                  
    
                // Préparation de l'envoi de l'e-mail
                $to = 'homeaway01000@gmail.com'; // Adresse e-mail où le message sera envoyé
                $subject = 'Nouveau message de contact'; // Sujet de l'e-mail
                $headers = "From: $mail\r\n"; // Adresse e-mail de l'expéditeur
                $headers .= "Reply-To: $mail\r\n"; // Adresse e-mail de réponse
    
                $messageToSend = "Nom : $name\n";
                $messageToSend .= "Email : $mail\n\n";
                $messageToSend .= "Message :\n$message";
    
                // Envoi de l'e-mail
                if (mail($to, $subject, $messageToSend, $headers)) {
                    echo "Message envoyé avec succès";
                } else {
                    echo "Échec de l'envoi du message";
            }
                      
            $twig = $this->getTwig();
            echo $twig->render('contactHote.html.twig', []);
        }
    }
    
}