<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 4:06 PM
 */

namespace App\TravelAdvisor\Domain\Services;


use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Model\NullCard;

class CardSorter
{
    /**
     * @var BoardingCardInterface[]
     */
    private $unsortedCards;

    /**
     * @var BoardingCardInterface[]
     */
    private $sortedCards = [];

    /**
     * Sorter constructor.
     * @param BoardingCardInterface[] $unsortedCards
     */
    public function __construct(array $unsortedCards)
    {
        $this->unsortedCards = $unsortedCards;
    }

    public function getFirst() : BoardingCardInterface
    {
        if(!empty($this->unsortedCards)) {
            foreach ($this->unsortedCards as $key => $card) {
                $prev = $card->getPrev($this->unsortedCards);
                if ($prev instanceof NullCard) {
                    unset($this->unsortedCards[$key]);
                    return $card;
                }
            }
        }
        return NullCard::createFromJson();
    }


    public function sort()
    {
        while(count($this->unsortedCards) > 0) {
            $firstBoardingCard = $this->getFirst();
            if(!$firstBoardingCard instanceof NullCard) {
                $this->sortedCards[] = $firstBoardingCard;
            }
        }
        $this->sortedCards[] = NullCard::createFromJson();
    }

    /**
     * @return BoardingCardInterface[]
     */
    public function getSortedCards()
    {
        return $this->sortedCards;
    }
}