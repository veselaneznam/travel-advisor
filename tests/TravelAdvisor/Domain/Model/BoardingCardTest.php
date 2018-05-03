<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 9:38 AM
 */

namespace App\Tests\TravelAdvisor\Domain\Model;

use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Model\AirportCard;
use App\TravelAdvisor\Domain\Model\BusStationCard;
use App\TravelAdvisor\Domain\Model\NullCard;
use App\TravelAdvisor\Domain\Model\TrainStationCard;
use App\TravelAdvisor\Domain\Services\BoardingCardJsonRepresenter;
use PHPUnit\Framework\TestCase;

class BoardingCardTest extends TestCase
{
    /**
     * @throws MissingArgumentException
     */
    public function testGetNext()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/unsorted_cards.json'));
        $boardingCard = BusStationCard::createFromJson($data[0]);
        $unsortedCards = array_map(function ($card){
            return BoardingCardJsonRepresenter::toDomain($card);
        }, $data);
        $expectedArray = [
            'transportationType' => 'train',
            'startDirection' => 'Plovdiv Train Station',
            'endDirection' => 'Burgas',
            'seat' => '1C',
            'gate' => '1B',
            'luggageInstructions' => 'Get your luggage from Gate B11',
            'cardNumber' => '12WE'
        ];
        $expectedCard = TrainStationCard::createFromJson(json_decode(json_encode($expectedArray)));
        $this->assertEquals($expectedCard, $boardingCard->getNext($unsortedCards));

        $this->assertEquals(NullCard::createFromJson(), $expectedCard->getNext($unsortedCards));
    }

    /**
     * @throws MissingArgumentException
     */
    public function testGetPrev()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/unsorted_cards.json'));
        $boardingCard = TrainStationCard::createFromJson($data[2]);
        $unsortedCards = array_map(function ($card){
            return BoardingCardJsonRepresenter::toDomain($card);
        }, $data);
        $expectedArray = $data[0];
        $expectedCard = BusStationCard::createFromJson(json_decode(json_encode($expectedArray)));
        $this->assertEquals($expectedCard, $boardingCard->getPrev($unsortedCards));
        $secondExpected = $data[3];
        $secondExpectedCard = AirportCard::createFromJson(json_decode(json_encode($secondExpected)));
        $this->assertEquals($secondExpectedCard, $expectedCard->getPrev($unsortedCards));
    }

    public function testIsFirst()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/unsorted_cards.json'));
        $unsortedCards = array_map(function ($card){
            return BoardingCardJsonRepresenter::toDomain($card);
        }, $data);

        $boardingCard = TrainStationCard::createFromJson($data[2]);
        $this->assertFalse($boardingCard->isFirst($unsortedCards));

        $firstBoardingCard = BusStationCard::createFromJson($data[1]);
        $this->assertTrue($firstBoardingCard->isFirst($unsortedCards));
    }
}