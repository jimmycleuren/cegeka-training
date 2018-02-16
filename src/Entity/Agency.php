<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgencyRepository")
 */
class Agency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private $url;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hotel", mappedBy="agency")
     */
    private $hotels;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="agency")
     */
    private $flights;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUrl($url) {
        $this->url = $url;
    }
    
    function getHotels() {
        return $this->hotels;
    }

    function getFlights() {
        return $this->flights;
    }

    function setHotels($hotels) {
        $this->hotels = $hotels;
    }

    function setFlights($flights) {
        $this->flights = $flights;
    }
    
    public function __toString() {
        return $this->name;
    }
}
