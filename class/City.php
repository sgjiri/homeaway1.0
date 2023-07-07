<?php
class City
{
    private $id_ville;
   
    private $ville_nom;
    private $img;
    private $place;



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

    public function getId_ville ()
    {
        return $this->id_ville ;
    }
   
    public function getVille_nom()
    {
        return $this->ville_nom;
    }
    

    public function getImg()
    {
        return $this->img;
    }

    public function getPlace()
    {
        return $this->place;
    }



    // -*-*-*-*-*-*-*-*-SETTERS-*-*-*-*-*-*-*-*-//


    public function setId_ville(int $id_ville)
    {
        $this->id_ville = $id_ville;
    }
  
    public function setVille_nom(string $ville_nom)
    {
        $this->ville_nom = $ville_nom;
    }
  
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    public function setPlace(string $place)
    {
        $this->place = $place;
    }
}
