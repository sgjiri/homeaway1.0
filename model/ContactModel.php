<?php

class ContactModel extends Model
{
    public function insertMessage($name, $mail, $message)
    {
        $reqContact = 'INSERT INTO messages (name, mail, message) VALUES (:name, :mail, :message)';
        $reqContactMe = $this->getDb()->prepare($reqContact);

        $reqContactMe->bindParam(':name', $name);
        $reqContactMe->bindParam(':mail', $mail);
        $reqContactMe->bindParam(':message', $message);
        $reqContactMe->execute();
    }
}
