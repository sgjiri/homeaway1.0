<?php
class Messages
{
    private $id_message;
    private $name;
    private $mail;
    private $message;
    private $created_at;




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


    // *-*-*-*GETTERS*-*-*-*

    public function getIdMessage()
    {
        return $this->id_message;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }


    // *-*-*-*-SETTERS*-*-*-*-

    public function setIdMessage(int $id_message)
    {
        $this->id_message = $id_message;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }
}
