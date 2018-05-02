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
use App\TravelAdvisor\Domain\Repository\DirectionRepository;
use App\TravelAdvisor\Domain\Values\LinkedObject;

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
        $head = new LinkedObject($firstElement, null, $firstElement->getNext($boardingCardList));

        $this->append($boardingCardList, $head);

        return array_map(function(BoardingCardInterface $element) {
            return BoardingCardJsonRepresenter::toString($element);
        }, $head->toArray());
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

    /**
     * @param array $boardingCardList
     * @param $head
     */
    private function append(array $boardingCardList, LinkedObject &$head): void
    {
        foreach ($boardingCardList as $key => $boardingCard) {
            if(!empty($boardingCardList)) {
                if ($head->getNext() == $boardingCard) {
                    $head->append(new LinkedObject(
                        $boardingCard,
                        $boardingCard->getPrev($boardingCardList),
                        $boardingCard->getNext($boardingCardList)
                    ));
                    unset($boardingCardList[$key]);
                    $this->append($boardingCardList, $head);
                }
            }
        }
    }
}