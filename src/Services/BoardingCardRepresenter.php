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
    public function toDomain(string $text) : BoardingCardInterface;

    /**
     * @param BoardingCardInterface $boardingCard
     * @return string
     */
    public function toString(BoardingCardInterface $boardingCard) : string;
}