<?php
class Image
{
    private $id_image;
    private $thumbnail;
    private $id_logement;



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


    // ***********************************************GETTERS ET SETTERS *****************************************************//

    // *-*-*-*-*-*-*-* GETTERS *-*-*-*-*-*-*-*//

    public function getIdImage()
    {
        return $this->id_image;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function getIdLogement()
    {
        return $this->id_logement;
    }

    // *-*-*-*-*-*-*-* SETTERS *-*-*-*-*-*-*-*//

    public function setIdImage(INT $id_image)
    {
        $this->id_image = $id_image;
    }

    public function setThumbnail(STRING $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    public function setIdLogement(INT $id_logement)
    {
        $this->id_logement = $id_logement;
    }
}
