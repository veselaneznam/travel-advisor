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
use App\TravelAdvisor\Domain\Model\NullCard;

class BoardingCardService implements BoardingCardServiceInterface
{

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return mixed
     */
    public function sort(array $boardingCardList)
    {
        $head = [];
        while(count($boardingCardList) > 0) {
           list($firstBoardingCard, $key) = $this->getFirst($boardingCardList);
           if(null !== $key && null !== $firstBoardingCard) {
               unset($boardingCardList[$key]);
               $head[] = $firstBoardingCard;
           }
        }

        return array_map(function(BoardingCardInterface $element) {
            return BoardingCardJsonRepresenter::toString($element);
        }, $head);
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return array
     */
    public function getFirst(array $boardingCardList) : array
    {
        foreach ($boardingCardList as $key => $boardingCard) {
            $prev = $boardingCard->getPrev($boardingCardList);
            if ($prev instanceof NullCard) {
                return [$boardingCard, $key];
            }
        }
        return [null, null];
    }
}