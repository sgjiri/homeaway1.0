<?php
class PersonModel extends Model
{
    // -------CONNEXION-------//

     
    public function getPersonById($id)
{
    $req = $this->getDb()->prepare("SELECT `mail`, `password`, `id_person` FROM `person` WHERE `id_person` = :id LIMIT 0, 1");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->execute();

    return $req->fetch(PDO::FETCH_ASSOC);
}
    public function getUserByMail(String $mail)
    {
        $req = $this->getDb()->prepare("SELECT `mail`, `password`, `id_person` FROM `person` WHERE `mail` =:mail LIMIT 0, 25");

        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();

        return $req->rowCount() === 1 ? new Person($req->fetch(PDO::FETCH_ASSOC)) : false;
    }


    // -------INSCRIPTION-------//


    public function register(Person $person)
    {
        $name = $person->getName();
        $firstname = $person->getFirstname();
        $mail = $person->getMail();
        $date_of_birth = $person->getDateOfBirth();
        $phone_number = $person->getPhoneNumber();
        $password = $person->getPassword();
       

        $req = $this->getDb()->prepare('INSERT INTO `person` (`name`,`firstname`,`date_of_birth`,`phone_number`, `mail`, `password`) VALUES ( :name, :firstname, :date_of_birth, :phone_number, :mail, :password )');

        $req->bindParam(":name", $name, PDO::PARAM_STR);
        $req->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $req->bindParam(":date_of_birth", $date_of_birth, PDO::PARAM_STR);
        $req->bindParam(":phone_number", $phone_number, PDO::PARAM_INT);
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);

        $req->execute();
    }

    public function deleteUser($idUser)
    {
        $reqDelete = $this->getDb()->prepare('DELETE FROM `person` WHERE `id_person` = :idUser');

        $reqDelete->bindParam('idUser', $idUser, PDO::PARAM_INT);

        $reqDelete->execute();
    }

}
