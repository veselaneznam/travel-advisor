<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:14 AM
 */

namespace App\TravelAdvisor\Domain\Model;


abstract class BoardingCard implements BoardingCardInterface
{
    /**
     * @var string
     */
    protected $startDirection;

    /**
     * @var string
     */
    protected $endDirection;

    /**
     * @var string
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

    /**
     * @return string
     */
    public function getStartDirection() : string
    {
        return $this->startDirection;
    }

    /**
     * @return string
     */
    public function getEndDirection(): string
    {
        return $this->endDirection;
    }

    public function toArray() : array
    {
        return [
            'instructions' => $this->getInstructions()
        ];
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return BoardingCardInterface|null
     */
    public function getNext(array $boardingCardList):BoardingCardInterface
    {
        foreach ($boardingCardList as $boardingCard) {
            if($this->getEndDirection() == $boardingCard->getStartDirection()) {
                return $boardingCard;
            }
        }
        return new NullCard();
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return BoardingCardInterface|null
     */
    public function getPrev(array $boardingCardList):BoardingCardInterface
    {
        foreach ($boardingCardList as $boardingCard) {
            if($this->getStartDirection() == $boardingCard->getEndDirection()) {
                return $boardingCard;
            }
        }
        return new NullCard();
    }

    /**
     * @param array $boardingCardList
     * @return bool
     */
    public function isFirst(array $boardingCardList): bool
    {
       return ($this->getPrev($boardingCardList) instanceof NullCard) ? true : false;
    }
}