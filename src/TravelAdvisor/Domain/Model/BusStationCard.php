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
    private const TRANSPORTATION_TYPE = 'bus';

    /**
     * @var int
     */
    private $busNumber;

    /**
     * BusStation constructor.
     * @param Direction $startDirection
     * @param Direction $endDirection
     * @param int $busNumber
     */
    public function __construct(Direction $startDirection, Direction $endDirection, int $busNumber)
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
    public static function createFromJson($jsonObject): BoardingCardInterface
    {
        if(!property_exists('startDirection', $jsonObject)) {
            throw new MissingArgumentException('Missing property startDirection', 400);
        }
        if(!property_exists('endDirection', $jsonObject)) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }
        if(!property_exists('busNumber', $jsonObject)) {
            throw new MissingArgumentException('Missing property busNumber', 400);
        }
        $startDirection = Direction::createFromJson($jsonObject->startDirection);
        $endDirection = Direction::createFromJson($jsonObject->endDirection);
        $busNumber = $jsonObject->busNumber;

        return new BusStationCard($startDirection, $endDirection, $busNumber);
    }

    /**
     * @return Direction
     */
    public function getStartDirection(): Direction
    {
        return $this->startDirection;
    }

    /**
     * @return int
     */
    public function getBusNumber(): int
    {
        return $this->busNumber;
    }

    /**
     * @return Direction
     */
    public function getEndDirection(): Direction
    {
        return $this->endDirection;
    }

    public function getTransportationType(): string
    {
        return self::TRANSPORTATION_TYPE;
    }

    public function getPointNumber(): string
    {
        return $this->busNumber;
    }

    public function getLuggageInstructions(): string
    {
        return '';
    }

    public function getSeatNumber(): string
    {
        return 'No seat assignment';
    }

    public function getInstructions(): string
    {
        // TODO: Implement getInstructions() method.
    }
}