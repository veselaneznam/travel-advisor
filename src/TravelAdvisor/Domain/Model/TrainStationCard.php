<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:26 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Values\Seat;

class TrainStationCard extends BoardingCard
{
    private const TRANSPORTATION_TYPE = 'train';

    /**
     * @var int
     */
    private $trainNumber;

    /**
     * @param Direction $startDirection
     * @param Direction $endDirection
     * @param Seat $seat
     * @param int $trainNumber
     * @param string $gate
     * @param string $luggageInstructions
     */
    private function __construct(
        Direction $startDirection,
        Direction $endDirection,
        Seat $seat,
        int $trainNumber,
        string $gate,
        string $luggageInstructions
    )
    {
        $this->startDirection = $startDirection;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->luggageInstructions = $luggageInstructions;
        $this->endDirection = $endDirection;
        $this->trainNumber = $trainNumber;
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
        if(!property_exists('trainNumber', $jsonObject)) {
            throw new MissingArgumentException('Missing property trainNumber', 400);
        }

        $startDirection = Direction::createFromJson($jsonObject->startDirection);
        $endDirection = Direction::createFromJson($jsonObject->endDirection);
        $seat = new Seat($jsonObject->seat->number, $jsonObject->seat->letter, $jsonObject->seat->side);
        $gate = $jsonObject->gate;
        $luggageInstructions = $jsonObject->luggageInstructions;
        $trainNumber = $jsonObject->trainNumber;

        return new TrainStationCard($startDirection, $endDirection, $seat, $trainNumber, $gate, $luggageInstructions);
    }

    public function getTransportationType(): string
    {
        return self::TRANSPORTATION_TYPE;
    }

    public function getPointNumber(): string
    {
        return $this->trainNumber;
    }

    public function getLuggageInstructions(): string
    {
        // TODO: Implement getLaggageIstructions() method.
    }

}