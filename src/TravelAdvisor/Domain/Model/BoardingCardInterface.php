<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:12 AM
 */

namespace App\TravelAdvisor\Domain\Model;


interface BoardingCardInterface
{
    /**
     * @return string
     */
    public function getStartDirection(): string ;

    /**
     * @return string
     */
    public function getTransportationType() : string;

    /**
     * @return string
     */
    public function getPointNumber(): string;

    /**
     * @return string
     */
    public function getSeatNumber(): string;

    /**
     * @return string|null
     */
    public function getEndDirection(): string;

    /**
     * @return string
     */
    public function getInstructions() : string;

    /**
     * @param \stdClass $jsonObject
     * @return BoardingCardInterface
     */
    public static function createFromJson(\stdClass $jsonObject) : BoardingCardInterface;

    /**
     * @param array $boardingCards
     * @return BoardingCardInterface
     */
    public function getNext(array $boardingCards) : BoardingCardInterface;

    /**
     * @param array $boardingCards
     * @return BoardingCardInterface
     */
    public function getPrev(array $boardingCards) : BoardingCardInterface;

    /**
     * @param array $boardingCards
     * @return bool
     */
    public function isFirst(array $boardingCards) : bool;

    /**
     * @return array
     */
    public function toArray() : array;
}