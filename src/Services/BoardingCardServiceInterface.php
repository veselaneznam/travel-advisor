<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 12:04 PM
 */

namespace App\Services;

use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

interface BoardingCardServiceInterface
{
    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return array
     */
    public function getSortedCardsAsArray(array $boardingCardList);

    /**
     * @param $boardingCardList
     * @return mixed
     */
    public function getFirstCardAsArray(array $boardingCardList);

    /**
     * @return array
     */
    public function getAllCardsAsJsonString() : array;
}