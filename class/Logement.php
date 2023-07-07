<?php
class Logement
{
    private $id_logement;
    private $id_person;
    private $title;
    private $type;
    private $surface;
    private $description;
    private $adress;
    private $adressCode;
    private $city;
    private $location;
    private $latitude;
    private $longitude;
    private $price_by_night;
    private $number_of_person;
    private $number_of_beds;
    private $parking;
    private $wifi;
    private $piscine;
    private $animals;
    private $kitchen;
    private $garden;
    private $tv;
    private $climatisation;
    private $camera;
    private $home_textiles;
    private $spa;
    private $jacuzzi;



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



    // ************************************************GETTERS ET SETTERS***********************************************************//

    // -*-*-*-*-*-*-*-* GETTERS *-*-*-*-*-*-*-*-*-//

    public function getId_logement()
    {
        return $this->id_logement;
    }

    public function getId_person()
    {
        return $this->id_person;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getSurface()
    {
        return $this->surface;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAdress()
    {
        return $this->adress;
    }
    public function getAdressCode()
    {
        return $this->adressCode;
    }

    public function getCity()
    {
        return $this->city;
    }
    public function getLocation()
    {
        return $this->location;
    }
    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getPrice_by_night()
    {
        return $this->price_by_night;
    }

    public function getNumber_of_person()
    {
        return $this->number_of_person;
    }

    public function getNumber_of_beds()
    {
        return $this->number_of_beds;
    }

    public function getParking()
    {
        return $this->parking;
    }
    public function getWifi()
    {
        return $this->wifi;
    }
    public function getPiscine()
    {
        return $this->piscine;
    }

    public function getAnimals()
    {
        return $this->animals;
    }
    public function getKitchen()
    {
        return $this->kitchen;
    }

    public function getGarden()
    {
        return $this->garden;
    }

    public function getTv()
    {
        return $this->tv;
    }

    public function getClimatisation()
    {
        return $this->climatisation;
    }

    public function getCamera()
    {
        return $this->camera;
    }

    public function getHome_textiles()
    {
        return $this->home_textiles;
    }
    public function getSpa()
    {
        return $this->spa;
    }

    public function getJacuzzi()
    {
        return $this->jacuzzi;
    }


    // -*-*-*-*-*-*-*-*SETTERS-*-*-*-*-*-*-*-*//


    public function setId_logement(int $id_logement)
    {
        $this->id_logement = $id_logement;
    }

    public function setId_person(int $id_person)
    {
        $this->id_person = $id_person;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setType(STRING $type)
    {
        $this->type = $type;
    }

    public function setSurface(int $surface)
    {
        $this->surface = $surface;
    }

    public function setDescription(STRING $description)
    {
        $this->description = $description;
    }

    public function setAdress(STRING $address)
    {
        $this->adress = $address;
    }

    public function setAdressCode(INT $adressCode)
    {
        $this->adressCode = $adressCode;
    }

    public function setCity(STRING $city)
    {
        $this->city = $city;
    }
    public function setLocation(STRING $location)
    {
        $this->location = $location;
    }

    public function setLatitude(int $latitude)
    {
        $this->latitude = $latitude;

    }

    public function setLongitude(int $longitude)
    {
        $this->longitude = $longitude;

    }

    public function setPrice_by_night(int $price_by_night)
    {
        $this->price_by_night = $price_by_night;
    }

    public function setNumber_of_person(int  $number_of_person)
    {
        $this->number_of_person = $number_of_person;
    }

    public function setNumber_of_beds(int  $number_of_beds)
    {
        $this->number_of_beds = $number_of_beds;
    }

    public function setParking(BOOL $parking)
    {
        $this->parking = $parking;
    }

    public function setWifi(BOOL $wifi)
    {
        $this->wifi = $wifi;
    }
    public function setPiscine(BOOL $piscine)
    {
        $this->piscine = $piscine;
    }
    public function setAnimals(BOOL $animals)
    {
        $this->animals = $animals;
    }
    public function setKitchen(BOOL $kitchen)
    {
        $this->kitchen = $kitchen;
    }
    public function setGarden(BOOL $garden)
    {
        $this->garden = $garden;
    }

    public function setTv(BOOL $tv)
    {
        $this->tv = $tv;
    }

    public function setClimatisation(BOOL $climatisation)
    {
        $this->climatisation = $climatisation;
    }


    public function setCamera(BOOL $camera)
    {
        $this->camera = $camera;
    }

    public function setHome_textiles(BOOL $home_textiles)
    {
        $this->home_textiles = $home_textiles;
    }

    public function setSpa(BOOL $spa)
    {
        $this->spa = $spa;
    }

    public function setJacuzzi(BOOL $jacuzzi)
    {
        $this->jacuzzi = $jacuzzi;
    }

   
    
}
