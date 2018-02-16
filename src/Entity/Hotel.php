<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     }
 * )
 */
class Hotel
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Agency", inversedBy="hotels")
     * @ORM\JoinColumn(nullable=true)
     */
    private $agency;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $remoteId;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=100)
     */
    private $location;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="date")
     */
    private $start;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="date")
     */
    private $end;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $stars;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="boolean")
     */
    private $owned;
    
    function getId() {
        return $this->id;
    }

    function getAgency() {
        return $this->agency;
    }

    function getName() {
        return $this->name;
    }

    function getLocation() {
        return $this->location;
    }

    function getStart() {
        return $this->start;
    }

    function getEnd() {
        return $this->end;
    }

    function getStars() {
        return $this->stars;
    }

    function getPrice() {
        return $this->price;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAgency($agency) {
        $this->agency = $agency;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setStart($start) {
        $this->start = $start;
    }

    function setEnd($end) {
        $this->end = $end;
    }

    function setStars($stars) {
        $this->stars = $stars;
    }

    function setPrice($price) {
        $this->price = $price;
    }
    
    function getOwned() {
        return $this->owned;
    }

    function setOwned($owned) {
        $this->owned = $owned;
    }
    function getRemoteId() {
        return $this->remoteId;
    }

    function setRemoteId($remoteId) {
        $this->remoteId = $remoteId;
    }
}
