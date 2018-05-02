<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:26 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

class TrainStationCard extends BoardingCard
{
    const TRANSPORTATION_TYPE = 'train';

    /**
     * @var string
     */
    private $trainNumber;

    /**
     * @param string $startDirection
     * @param string $endDirection
     * @param string $seat
     * @param string $trainNumber
     */
    private function __construct(
        string $startDirection,
        string $endDirection,
        string $seat,
        string $trainNumber
    )
    {
        $this->startDirection = $startDirection;
        $this->seat = $seat;
        $this->endDirection = $endDirection;
        $this->trainNumber = $trainNumber;
    }

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     */
    public static function createFromJson(\stdClass $jsonObject) : BoardingCardInterface
    {
        if(!property_exists($jsonObject, 'startDirection')) {
            throw new MissingArgumentException('Missing property startDirection', 400);
        }
        if(!property_exists($jsonObject, 'endDirection')) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }

        if(!property_exists($jsonObject,'seat')) {
            throw new MissingArgumentException('Missing property seat', 400);
        }

        if(!property_exists($jsonObject,'trainNumber')) {
            throw new MissingArgumentException('Missing property trainNumber', 400);
        }

        $startDirection = $jsonObject->startDirection;
        $endDirection = $jsonObject->endDirection;
        $seat = $jsonObject->seat;
        $trainNumber = $jsonObject->trainNumber;

        return new TrainStationCard($startDirection, $endDirection, $seat, $trainNumber);
    }

    public function getTransportationType(): string
    {
        return self::TRANSPORTATION_TYPE;
    }

    public function getPointNumber(): string
    {
        return $this->trainNumber;
    }

    /**
     * @return string
     */
    public function getSeatNumber(): string
    {
        return $this->seat;
    }

    public function getInstructions(): string
    {
        return sprintf(
            'Take train %s, from %s to %s. Sit in seat %s',
            $this->getPointNumber(),
            $this->getStartDirection(),
            $this->getEndDirection(),
            $this->getSeatNumber()
        );
    }
}