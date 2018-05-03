<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:14 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;

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
    protected $cardNumber;

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

    /**
     * @return array
     */
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
            if(property_exists($boardingCard, 'startDirection')
                && $this->getEndDirection() == $boardingCard->getStartDirection()
            ) {
                return $boardingCard;
            }
        }
        return NullCard::createFromJson();
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
        return NullCard::createFromJson();
    }

    /**
     * @param array $boardingCardList
     * @return bool
     */
    public function isFirst(array $boardingCardList): bool
    {
       return ($this->getPrev($boardingCardList) instanceof NullCard) ? true : false;
    }



    /**
     * @param \stdClass $jsonObject
     * @throws MissingArgumentException
     */
    protected static function validateBoardingCardInput(\stdClass $jsonObject)
    {
        if (!property_exists($jsonObject, 'startDirection')) {
            throw new MissingArgumentException('Missing property startDirection', 400);
        }
        if (!property_exists($jsonObject, 'endDirection')) {
            throw new MissingArgumentException('Missing property endDirection', 400);
        }

        if (!property_exists($jsonObject, 'seat')) {
            throw new MissingArgumentException('Missing property seat', 400);
        }
        if (!property_exists($jsonObject, 'cardNumber')) {
            throw new MissingArgumentException('Missing property cardNumber', 400);
        }
    }
}