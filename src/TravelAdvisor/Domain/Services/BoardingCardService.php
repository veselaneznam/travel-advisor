<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 11:59 AM
 */

namespace App\TravelAdvisor\Domain\Services;

use App\Services\BoardingCardServiceInterface;
use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

class BoardingCardService implements BoardingCardServiceInterface
{

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return mixed
     */
    public function getSortedCardsAsJsonString(array $boardingCardList)
    {
        $cardSorter = new CardSorter($boardingCardList);
        $cardSorter->sort();

        return array_map(function(BoardingCardInterface $element) {
            return BoardingCardJsonRepresenter::toString($element);
        }, $cardSorter->getSortedCards());
    }

    /**
     * @param $boardingCardList
     * @return mixed
     */
    public function getFirstCardAsJsonString(array $boardingCardList)
    {
        $cardSorter = new CardSorter($boardingCardList);
        $firstCard = $cardSorter->getFirst();

        return BoardingCardJsonRepresenter::toString($firstCard);
    }
}