<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 12:08 PM
 */

namespace App\Services;

use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

interface BoardingCardRepresenter
{
    /**
     * @param string $text
     * @return BoardingCardInterface
     */
    public static function toDomain(string $text) : BoardingCardInterface;

    /**
     * @param BoardingCardInterface $boardingCard
     * @return string
     */
    public static function toString(BoardingCardInterface $boardingCard) : string;
}