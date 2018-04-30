<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:25 AM
 */

namespace App\TravelAdvisor\Model;


class Airport implements Point
{
    private const TRANSPORTATION_TYPE = 'flight';

    /**
     * @var Direction
     */
    private $direction;

    /**
     * @var int
     */
    private $flightNumber;

    /**
     * Airport constructor.
     * @param Direction $direction
     * @param int $flightNumber
     */
    public function __construct(Direction $direction, int $flightNumber)
    {
        $this->direction = $direction;
        $this->flightNumber = $flightNumber;
    }

    /**
     * @return Direction
     */
    public function getDirection() : Direction
    {
       return $this->direction;
    }


    public function getTransportationType() : string
    {
        return self::TRANSPORTATION_TYPE;
    }
}