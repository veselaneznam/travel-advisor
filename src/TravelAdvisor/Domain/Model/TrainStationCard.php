<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:26 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

final class TrainStationCard extends BoardingCard
{
    const TRANSPORTATION_TYPE = 'train';

    /**
     * @param string $startDirection
     * @param string $endDirection
     * @param string $seat
     * @param string $cardNumber
     */
    private function __construct(
        string $startDirection,
        string $endDirection,
        string $seat,
        string $cardNumber
    )
    {
        $this->startDirection = $startDirection;
        $this->seat = $seat;
        $this->endDirection = $endDirection;
        $this->cardNumber = $cardNumber;
    }

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     */
    public static function createFromJson(\stdClass $jsonObject) : BoardingCardInterface
    {
        parent::validateBoardingCardInput($jsonObject);

        $startDirection = $jsonObject->startDirection;
        $endDirection = $jsonObject->endDirection;
        $seat = $jsonObject->seat;
        $cardNumber = $jsonObject->cardNumber;

        return new TrainStationCard($startDirection, $endDirection, $seat, $cardNumber);
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
    public function getCardNumber(): string
    {
        return $this->cardNumber;
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
            'Take train %s, from %s to %s. Sit in seat %s',
            $this->getCardNumber(),
            $this->getStartDirection(),
            $this->getEndDirection(),
            $this->getSeatNumber()
        );
    }
}