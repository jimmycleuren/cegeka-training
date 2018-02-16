<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     }
 * )
 */
class Flight
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Agency", inversedBy="flights")
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
    private $airline;
    
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
     * @ORM\Column(type="time")
     */
    private $timeofday;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $duration;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(name="from_location", type="string", length=100)
     */
    private $from;
    
    /**
     * @Groups({"read"})
     * @ORM\Column(name="to_location", type="string", length=100)
     */
    private $to;
    
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

    function getAirline() {
        return $this->airline;
    }

    function getStart() {
        return $this->start;
    }

    function getEnd() {
        return $this->end;
    }

    function getTimeofday() {
        return $this->timeofday;
    }

    function getDuration() {
        return $this->duration;
    }

    function getFrom() {
        return $this->from;
    }

    function getTo() {
        return $this->to;
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

    function setAirline($airline) {
        $this->airline = $airline;
    }

    function setStart($start) {
        $this->start = $start;
    }

    function setEnd($end) {
        $this->end = $end;
    }

    function setTimeofday($timeofday) {
        $this->timeofday = $timeofday;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setTo($to) {
        $this->to = $to;
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
