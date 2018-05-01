<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:25 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Values\Seat;

class AirportCard extends BoardingCard
{
    private const TRANSPORTATION_TYPE = 'airport';

    /**
     * @var int
     */
    private $flightNumber;

    /**
     * @param Direction $startDirection
     * @param Direction $endDirection
     * @param Seat $seat
     * @param int $flightNumber
     * @param string $gate
     * @param string $luggageInstructions
     */
    private function __construct(
        Direction $startDirection,
        Direction $endDirection,
        Seat $seat,
        int $flightNumber,
        string $gate,
        string $luggageInstructions
    )
    {
        $this->startDirection = $startDirection;
        $this->flightNumber = $flightNumber;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->luggageInstructions = $luggageInstructions;
        $this->endDirection = $endDirection;
    }

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     */
    public static function createFromJson($jsonObject) : BoardingCardInterface
    {
        if(!property_exists('startDirection', $jsonObject)) {
            throw new MissingArgumentException('Missing property startDirection', 400);
        }
        if(!property_exists('endDirection', $jsonObject)) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }
        if(!property_exists('endDirection', $jsonObject)) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }
        if(!property_exists('seat', $jsonObject)) {
            throw new MissingArgumentException('Missing property seat', 400);
        }
        if(!property_exists('gate', $jsonObject)) {
            throw new MissingArgumentException('Missing property gate', 400);
        }
        if(!property_exists('luggageInstructions', $jsonObject)) {
            throw new MissingArgumentException('Missing property luggageInstructions', 400);
        }
        if(!property_exists('flightNumber', $jsonObject)) {
            throw new MissingArgumentException('Missing property flightNumber', 400);
        }

        $startDirection = Direction::createFromJson($jsonObject->startDirection);
        $endDirection = Direction::createFromJson($jsonObject->endDirection);
        $seat = new Seat($jsonObject->seat->number, $jsonObject->seat->letter, $jsonObject->seat->side);
        $gate = $jsonObject->gate;
        $luggageInstructions = $jsonObject->luggageInstructions;
        $flightNumber = $jsonObject->flightNumber;

        return new AirportCard($startDirection, $endDirection, $seat, $flightNumber, $gate, $luggageInstructions);
    }

    public function getTransportationType() : string
    {
        return self::TRANSPORTATION_TYPE;
    }

    public function getPointNumber(): string
    {
        return $this->flightNumber;
    }

    public function getLuggageInstructions(): string
    {
        return $this->luggageInstructions;
    }


    public function getInstructions(): string
    {
        // TODO: Implement getInstructions() method.
    }
}