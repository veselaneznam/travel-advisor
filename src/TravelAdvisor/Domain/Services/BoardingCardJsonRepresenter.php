<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 12:10 PM
 */

namespace App\TravelAdvisor\Domain\Services;


use App\Services\BoardingCardRepresenter;
use App\TravelAdvisor\Domain\Model\AirportCard;
use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Model\BusStationCard;
use App\TravelAdvisor\Domain\Model\TrainStationCard;
use App\TravelAdvisor\Domain\Repository\DirectionRepository;
use App\TravelAdvisor\Domain\Values\BoardingCardType;

class BoardingCardJsonRepresenter implements BoardingCardRepresenter
{
    /**
     * @var DirectionRepository
     */
    private $directionRepository;

    /**
     * BoardingCardJsonRepresenter constructor.
     * @param DirectionRepository $directionRepository
     */
    public function __construct(DirectionRepository $directionRepository)
    {
        $this->directionRepository = $directionRepository;
    }

    /**
     * @param string $text
     * @return BoardingCardInterface
     * @throws \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     */
    public function toDomain(string $text): BoardingCardInterface
    {
        $boardingCard = json_decode($text);
        $instance = null;
        if (property_exists($boardingCard, 'transportationType')) {
            switch ($boardingCard->transportationType) {
                case BoardingCardType::AIRPORT: return AirportCard::createFromJson($boardingCard);
                case BoardingCardType::BUS: return BusStationCard::createFromJson($boardingCard);
                case BoardingCardType::TRAIN: return TrainStationCard::createFromJson($boardingCard);
            }
        }
    }

    /**
     * @param BoardingCardInterface $boardingCard
     * @return string
     */
    public function toString(BoardingCardInterface $boardingCard): string
    {
        return json_encode($boardingCard->toArray());
    }
}