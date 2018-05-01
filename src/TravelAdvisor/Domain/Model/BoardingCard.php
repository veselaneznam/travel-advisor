<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:14 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Values\Seat;

abstract class BoardingCard implements BoardingCardInterface
{
    /**
     * @var Direction
     */
    protected $startDirection;

    /**
     * @var Direction
     */
    protected $endDirection;

    /**
     * @var Seat
     */
    protected $seat;

    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $luggageInstructions;


    public function getInstructions(): string
    {
        // TODO: Implement getInstructions() method.
    }


    /**
     * @return Direction
     */
    public function getStartDirection() : Direction
    {
        return $this->startDirection;
    }

    /**
     * @return Direction
     */
    public function getEndDirection(): Direction
    {
        return $this->endDirection;
    }

    /**
     * @return string
     */
    public function getSeatNumber(): string
    {
        return 'Gate ' . $this->gate . ', ' . $this->seat->getSeat();
    }

    public function toArray() : array
    {
        return [
            'startDirection' => $this->startDirection->toArray(),
            'endDirection' => $this->endDirection->toArray(),
            'transportationType' => $this->getTransportationType(),
            'pointNumber' => $this->getPointNumber(),
            'seatNumber' => $this->getSeatNumber(),
            'luggageInstructions' => $this->getLuggageInstructions(),
            'instructions' => $this->getInstructions()
        ];
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return BoardingCardInterface|mixed
     */
    public function getNext(array $boardingCardList):BoardingCardInterface
    {
        foreach ($boardingCardList as $boardingCard) {
            if($this->getEndDirection()->getName() == $boardingCard->getStartDirection()->getName()) {
                return $boardingCard;
            }
        }
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return BoardingCardInterface|mixed
     */
    public function getPrev(array $boardingCardList):BoardingCardInterface
    {
        foreach ($boardingCardList as $boardingCard) {
            if($this->startDirection->getName() == $boardingCard->getEndDirection()->getName()) {
                return $boardingCard;
            }
        }
        return $this;
    }
}