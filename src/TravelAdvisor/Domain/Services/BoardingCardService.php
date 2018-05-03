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
use App\TravelAdvisor\Domain\Repository\BoardingCardRepository;

class BoardingCardService implements BoardingCardServiceInterface
{
    /**
     * @var BoardingCardRepository
     */
    private $boardingCardRepository;

    /**
     * BoardingCardService constructor.
     * @param BoardingCardRepository $boardingCardRepository
     */
    public function __construct(BoardingCardRepository $boardingCardRepository)
    {
        $this->boardingCardRepository = $boardingCardRepository;
    }

    public function getAllCardsAsJsonString(): array
    {
        return $this->boardingCardRepository->findAll();
    }

    /**
     * @param BoardingCardInterface[] $boardingCardList
     * @return mixed
     */
    public function getSortedCardsAsArray(array $boardingCardList)
    {
        $cardSorter = new CardSorter($boardingCardList);
        $cardSorter->sort();

        return array_map(function(BoardingCardInterface $element) {
            return $element->toArray();
        }, $cardSorter->getSortedCards());
    }

    /**
     * @param $boardingCardList
     * @return mixed
     */
    public function getFirstCardAsArray(array $boardingCardList)
    {
        $cardSorter = new CardSorter($boardingCardList);
        $firstCard = $cardSorter->getFirst();

        return $firstCard->toArray();
    }
}