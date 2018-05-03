<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:24 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

final class BusStationCard extends BoardingCard
{
    const TRANSPORTATION_TYPE = 'bus';

    /**
     * BusStation constructor.
     * @param string $cardNumber
     * @param string $startDirection
     * @param string $endDirection
     * @param string $seat
     */
    public function __construct(string $cardNumber, string $startDirection, string $endDirection, string $seat)
    {
        $this->startDirection = $startDirection;
        $this->endDirection = $endDirection;
        $this->cardNumber = $cardNumber;
        $this->seat = $seat;
    }

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     */
    public static function createFromJson(\stdClass $jsonObject): BoardingCardInterface
    {
        parent::validateBoardingCardInput($jsonObject);

        $startDirection = $jsonObject->startDirection;
        $endDirection = $jsonObject->endDirection;
        $cardNumber = $jsonObject->cardNumber;
        $seat = $jsonObject->seat;

        return new BusStationCard($cardNumber, $startDirection, $endDirection, $seat);
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getTransportationType(): string
    {
        return self::TRANSPORTATION_TYPE;
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
    public function getInstructions(): string
    {
        return sprintf(
            'Take the bus %s from %s to %s. %s',
            $this->getCardNumber(),
            $this->getStartDirection(),
            $this->getEndDirection(),
            $this->getSeatNumber()
        );
    }
}