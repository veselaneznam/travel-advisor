<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:24 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

class BusStationCard extends BoardingCard
{
    const TRANSPORTATION_TYPE = 'bus';

    /**
     * @var string
     */
    private $busNumber;

    /**
     * BusStation constructor.
     * @param string $busNumber
     * @param string $startDirection
     * @param string $endDirection
     */
    public function __construct(string $busNumber, string $startDirection, string $endDirection)
    {
        $this->startDirection = $startDirection;
        $this->endDirection = $endDirection;
        $this->busNumber = $busNumber;
    }

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     */
    public static function createFromJson(\stdClass $jsonObject): BoardingCardInterface
    {
        if(!property_exists($jsonObject, 'startDirection')) {
            throw new MissingArgumentException('Missing property startDirection', 400);
        }
        if(!property_exists($jsonObject,'endDirection')) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }
        if(!property_exists($jsonObject, 'busNumber')) {
            throw new MissingArgumentException('Missing property busNumber', 400);
        }

        $startDirection = $jsonObject->startDirection;
        $endDirection = $jsonObject->endDirection;
        $busNumber = $jsonObject->busNumber;

        return new BusStationCard($busNumber, $startDirection, $endDirection);
    }

    /**
     * @return int
     */
    public function getBusNumber(): int
    {
        return $this->busNumber;
    }

    public function getTransportationType(): string
    {
        return self::TRANSPORTATION_TYPE;
    }

    public function getPointNumber(): string
    {
        return $this->busNumber;
    }

    public function getSeatNumber(): string
    {
        return 'No seat assignment.';
    }

    public function getInstructions(): string
    {
        return sprintf(
            'Take the bus from %s to %s. %s',
            $this->getStartDirection(),
            $this->getEndDirection(),
            $this->getSeatNumber()
        );
    }
}