<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 12:10 PM
 */

namespace App\TravelAdvisor\Domain\Services;


use App\Services\BoardingCardRepresenter;
use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Exceptions\NotImplementedException;
use App\TravelAdvisor\Domain\Model\AirportCard;
use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Model\BusStationCard;
use App\TravelAdvisor\Domain\Model\NullCard;
use App\TravelAdvisor\Domain\Model\TrainStationCard;
use App\TravelAdvisor\Domain\Values\BoardingCardType;

class BoardingCardJsonRepresenter implements BoardingCardRepresenter
{
    /**
     * @param $jsonObject
     * @return BoardingCardInterface
     * @throws MissingArgumentException
     * @throws NotImplementedException
     */
    public static function toDomain(\stdClass $jsonObject): BoardingCardInterface
    {
        if (empty($jsonObject)) {
            throw new MissingArgumentException('Empty object', 400);
        }

        if (property_exists($jsonObject, 'transportationType')) {

            switch ($jsonObject->transportationType) {
                case BoardingCardType::AIRPORT: return AirportCard::createFromJson($jsonObject);
                case BoardingCardType::BUS: return BusStationCard::createFromJson($jsonObject);
                case BoardingCardType::TRAIN: return TrainStationCard::createFromJson($jsonObject);
                case BoardingCardType::NONE: return NullCard::createFromJson($jsonObject);
                default:
                    throw new NotImplementedException(
                        sprintf('This card type %s is not implemented', $jsonObject->transportationType),
                        400
                    );
            }
        }
        throw new MissingArgumentException('Missing property transportationType', 400);
    }
}