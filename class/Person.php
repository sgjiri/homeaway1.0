<?php
class Person
{
    private $id_person;
   
    private $name;
    private $firstname;
    private $date_of_birth;
    private $password;
    private $phone_number;
    private $mail;



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



    // **************************************************GETTERS ET SETTERS***********************************************************//

    // -*-*-*-*-*-*-*-*-*-*GETTERS*-*-*-*-*-*-*-*-*//

    public function getIdPerson()
    {
        return $this->id_person;
    }

   
    public function getName()
    {
        return $this->name;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function getMail()
    {
        return $this->mail;
    }


    // -*-*-*-*-*-*-*-*-SETTERS-*-*-*-*-*-*-*-*-//


    public function setIdPerson(int $id_person)
    {
        $this->id_person = $id_person;
    }

  
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    public function setDateOfBirth(string $date_of_birth)
    {
        $this->date_of_birth = $date_of_birth;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setPhoneNumber(int $phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }
}
