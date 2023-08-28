<?php


class PersonController extends Controller
{
    public function userLogin()
    {
        // Vérifie si l'utilisateur est déjà connecté, si oui, redirection vers l'accueil

        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {
            global $router;
            header('Location: ' . $router->generate('home'));
            exit();
           
        }
        //  vérifie si le tableau $_POST est vide, si oui affiche la page login

        if (!$_POST) {
             $twig = $this->getTwig();
            echo $twig->render('homePage.html.twig', []);
        } else {

            // si $post non vide recuperation des valeurs des champs dans le formulaire a travers variable $mail et $password

            $mail = $_POST['mail'];

            $password = $_POST['password'];

            // creation instance model qui app la methode getuserbymail pour récuperation des info utilisateur

            $model = new PersonModel();
            $person = $model->getUserByMail($mail);

            // si util trouvé et que $person diff de nul verif du mdp si celui ci ok alors données util seront stockées dans variable de session $session 

            if ($person) {
                if (password_verify($password, $person->getPassword())) {
                     $_SESSION['connect'] = true;
                    $_SESSION['id_person'] = $person->getId_person();

                    $_SESSION['mail'] = $person->getMail();
                 
                    global $router;
                     header('Location: '. $router->generate('home'));
                   exit();
                             
              
                }
            } else {
                // si password non ok affiche message erreur avec redirection 
                $message = "mail ou mot de passe incorrect !";
                 $twig = $this->getTwig();
            echo $twig->render('homepage.html.twig', ['message' =>$message]);
            }
        }
    }


    public function createPerson()
    {
        global $router;
        $model = new PersonModel();

        // vérifie si le formulaire a été soumis en utilisant la méthode HTTP POST. Si ok,  création d'un nouvel utilisateur.

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
            $date_of_birth = $_POST['date_of_birth'];
            $birthdate = date_create_from_format('Y-m-d', $date_of_birth);

            if (!$birthdate) {
            
                echo "La date de naissance n'est pas valide.";
                exit();
            }

            // Vérification de l'âge requis (18 ans)
            $now = new DateTime();
            $age = $now->diff($birthdate)->y;

            if ($age < 18) {
                echo "Vous devez avoir au moins 18 ans pour vous inscrire.";
                exit();
            }
            $phone_number = $_POST['phone_number'];
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];

          
            // Vérification du mot de passe
            if (strlen($rawPass) < 12 || !preg_match('/[A-Z]/', $rawPass) || !preg_match('/[a-z]/', $rawPass) || !preg_match('/[!@#$%^&*]/', $rawPass)) {
              
                echo "Le mot de passe doit contenir au moins 12 caractères avec au moins une majuscule, une minuscule et un caractère spécial.";
                exit();
            }
         
            $person = new Person([
                'mail' => $mail,
                'password' => $password,
                'name' => $name,
                'firstname' => $firstname,
                'date_of_birth' => $date_of_birth,
                'phone_number' => $phone_number

            ]);

            $model->register($person);

            // Connexion de l'utilisateur après l'inscription
            $model->login($mail);
            
            header('Location:  ./');
            exit();
          
        } else {

             $twig = $this->getTwig();
            echo $twig->render('homepage.html.twig', []);
        }
    }


    public function logout()
    {
        session_destroy();
        header('Location: ./');
        exit();
    }
}
