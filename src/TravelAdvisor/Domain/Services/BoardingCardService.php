<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 11:59 AM
 */

namespace App\TravelAdvisor\Domain\Services;

use App\Services\BoardingCardServiceInterface;
use App\TravelAdvisor\Domain\Model\BoardingCard;
use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Repository\BoardingCardRepository;
use App\TravelAdvisor\Domain\Repository\DirectionRepository;

class BoardingCardService implements BoardingCardServiceInterface
{
    /**
     * @var BoardingCardRepository
     */
    private $boardingCardRepository;

    /**
     * @var DirectionRepository
     */
    private $directionRepository;

    /**
     * BoardingCardService constructor.
     * @param BoardingCardRepository $boardingCardRepository
     * @param DirectionRepository $directionRepository
     */
    public function __construct(BoardingCardRepository $boardingCardRepository, DirectionRepository $directionRepository)
    {
        $this->boardingCardRepository = $boardingCardRepository;
        $this->directionRepository = $directionRepository;
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return mixed
     */
    public function sort(array $boardingCardList)
    {
        $firstElement = $this->getFirst($boardingCardList);
        array_unshift($boardingCardList, $firstElement, $firstElement->getNext());
        $result = [];
        $size = count($boardingCardList) - 1;
         for ($i = 1; $i <= $size; $i ++) {
             $result[] = $boardingCardList[$i]->getNext($boardingCardList);
         }

         return [$firstElement] + $result;
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return mixed
     */
    public function getFirst($boardingCardList)
    {
        foreach ($boardingCardList as $boardingCard) {
            if($boardingCard->getEndDirection()->getCoordinates() != null && $boardingCard->getStartDirection()->getCoordinates() !== null){
                $prev = $boardingCard->getPrev($boardingCardList);
                if($prev->getStartDirection()->getName() == $boardingCard->getStartDirection()->getName()) {
                   return $boardingCard;
                }
            }
        }
    }
}