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
     * @return Direction
     */
    public function getStartDirection() : Direction;

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
    public function getLuggageInstructions(): string;

    /**
     * @return string
     */
    public function getSeatNumber(): string;

    /**
     * @return Direction
     */
    public function getEndDirection() : Direction;

    /**
     * @return string
     */
    public function getInstructions() : string;

    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     */
    public static function createFromJson($jsonObject) : BoardingCardInterface;

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
}