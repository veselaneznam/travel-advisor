<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/2/2018
 * Time: 1:33 PM
 */

namespace App\TravelAdvisor\Domain\Model;


final class NullCard extends BoardingCard
{
    private function __construct()
    {

    }

    const TRANSPORTATION_TYPE = 'none';

    /**
     * @return string
     */
    public function getStartDirection(): string
    {
        return '';
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
        return '';
    }

    /**
     * @return string
     */
    public function getSeatNumber(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getEndDirection(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getInstructions(): string
    {
        return 'You have arrived at your final destination.';
    }

    /**
     * @param \stdClass $jsonObject
     * @return BoardingCardInterface
     */
    public static function createFromJson(\stdClass $jsonObject = null): BoardingCardInterface
    {
        return new NullCard();
    }

    /**
     * @param array $boardingCards
     * @return BoardingCardInterface
     */
    public function getNext(array $boardingCards = []): BoardingCardInterface
    {
        return new NullCard();
    }

    /**
     * @param array $boardingCards
     * @return BoardingCardInterface
     */
    public function getPrev(array $boardingCards = []): BoardingCardInterface
    {
        return new NullCard();
    }

}