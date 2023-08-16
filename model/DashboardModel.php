<?php
class DashboardModel extends Model
{
    public function getUser($idUser)
    {
        $reqUser = $this->getDb()->prepare('SELECT `name`,`firstname`,`date_of_birth`,`password`,`phone_number`,`mail`FROM `person` WHERE `id_person` = :idUser');
        $reqUser->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $reqUser->execute();
        $User = $reqUser->fetch(PDO::FETCH_ASSOC);

        return $User;
    }

    public function setName($lastname, $firstname, $idUser)
    {
        $reqUserId = $this->getDb()->prepare('SELECT `id_person` FROM `person` WHERE `id_person` = :idUser');
        $reqUserId->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $test = $reqUserId->execute();

        if ($test) {
            $updateName = $this->getDb()->prepare('UPDATE `person` SET `firstname` = :firstname, `name` = :lastname WHERE `id_person` = :userId');
            $updateName->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $updateName->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $updateName->bindParam(':userId', $idUser, PDO::PARAM_STR);
            return $updateName->execute();
        } else {
            return null;
        }
    }

    public function setMail($mail, $idUser)
    {

        $updateMail = $this->getDb()->prepare('UPDATE `person` SET `mail` = :mail WHERE `id_person` = :userId');
        $updateMail->bindParam(':mail', $mail, PDO::PARAM_STR);
        $updateMail->bindParam(':userId', $idUser, PDO::PARAM_STR);
        return $updateMail->execute();
    }


    public function setDateOfBird($dateOfBird, $idUser)
    {

        $updateMail = $this->getDb()->prepare('UPDATE `person` SET `date_of_birth` = :dateOfBird WHERE `id_person` = :userId');
        $updateMail->bindParam(':dateOfBird', $dateOfBird, PDO::PARAM_STR);
        $updateMail->bindParam(':userId', $idUser, PDO::PARAM_STR);
        return $updateMail->execute();
    }

    public function setTel($tel, $idUser)
    {

        $updateMail = $this->getDb()->prepare('UPDATE `person` SET `phone_number` = :tel WHERE `id_person` = :userId');
        $updateMail->bindParam(':tel', $tel, PDO::PARAM_STR);
        $updateMail->bindParam(':userId', $idUser, PDO::PARAM_STR);
        return $updateMail->execute();
    }

    public function setPassword($password, $passwordConfirme, $idUser, $passwordHashed)
    {
        if ($password === $passwordConfirme) {

            $updatePassword = $this->getDb()->prepare('UPDATE `person` SET `password` = :password WHERE `id_person` = :userId');
            $updatePassword->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
            $updatePassword->bindParam(':userId', $idUser, PDO::PARAM_STR);
            return $updatePassword->execute();
        }
    }
}
