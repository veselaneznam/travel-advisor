<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:25 AM
 */

namespace App\TravelAdvisor\Domain\Model;

use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

final class AirportCard extends BoardingCard
{
    const TRANSPORTATION_TYPE = 'airport';

    /**
     * @var string
     */
    private $flightNumber;

    /**
     * @var string
     */
    private $luggageInstructions;

    /**
     * @var string
     */
    private $gate;

    /**
     * @param string $seat
     * @param string $flightNumber
     * @param string $gate
     * @param string $luggageInstructions
     * @param string $startDirection
     * @param string $endDirection
     */
    private function __construct(
        string $seat,
        string $flightNumber,
        string $gate,
        string $luggageInstructions,
        string $startDirection,
        string $endDirection
    )
    {
        $this->flightNumber = $flightNumber;
        $this->seat = $seat;
        $this->gate = $gate;
        $this->luggageInstructions = $luggageInstructions;
        $this->startDirection = $startDirection;
        $this->endDirection = $endDirection;
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
        if(!property_exists($jsonObject,'gate')) {
            throw new MissingArgumentException('Missing property gate', 400);
        }
        if(!property_exists($jsonObject, 'luggageInstructions')) {
            throw new MissingArgumentException('Missing property luggageInstructions', 400);
        }
        if(!property_exists($jsonObject, 'flightNumber')) {
            throw new MissingArgumentException('Missing property flightNumber', 400);
        }

        $startDirection = $jsonObject->startDirection;
        $endDirection = $jsonObject->endDirection;
        $seat = $jsonObject->seat;
        $gate = $jsonObject->gate;
        $luggageInstructions = $jsonObject->luggageInstructions;
        $flightNumber = $jsonObject->flightNumber;

        return new AirportCard($seat, $flightNumber, $gate, $luggageInstructions, $startDirection, $endDirection);
    }

    /**
     * @return string
     */
    public function getTransportationType() : string
    {
        return self::TRANSPORTATION_TYPE;
    }

    /**
     * @return string
     */
    public function getPointNumber(): string
    {
        return $this->flightNumber;
    }

    /**
     * @return string
     */
    public function getLuggageInstructions(): string
    {
        return $this->luggageInstructions;
    }


    /**
     * @return string
     */
    public function getSeatNumber(): string
    {
        return $this->seat;
    }

    /**
     * @return string
     */
    public function getGate():string
    {
        return $this->gate;
    }


    /**
     * @return string
     */
    public function getInstructions(): string
    {
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s. %s',
            $this->getStartDirection(),
            $this->getPointNumber(),
            $this->getEndDirection(),
            $this->getGate(),
            $this->getSeatNumber(),
            $this->getLuggageInstructions()
        );
    }
}