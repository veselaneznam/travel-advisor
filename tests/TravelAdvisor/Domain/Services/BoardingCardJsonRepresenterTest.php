<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/2/18
 * Time: 8:28 PM
 */

namespace App\Tests\TravelAdvisor\Domain\Services;

use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Exceptions\NotImplementedException;
use App\TravelAdvisor\Domain\Model\AirportCard;
use App\TravelAdvisor\Domain\Model\BusStationCard;
use App\TravelAdvisor\Domain\Model\NullCard;
use App\TravelAdvisor\Domain\Model\TrainStationCard;
use App\TravelAdvisor\Domain\Services\BoardingCardJsonRepresenter;
use App\TravelAdvisor\Domain\Values\BoardingCardType;
use PHPUnit\Framework\TestCase;

class BoardingCardJsonRepresenterTest extends TestCase
{
    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     */
    public function testToDomainCreatesAirportCard()
    {
        $expected = [
            'transportationType' => BoardingCardType::AIRPORT,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'seat' => '1C',
            'gate' => '1B',
            'luggageInstructions' => 'Get your luggage from Gate B11',
            'cardNumber' => '12323BBB',
        ];
        $jsonString = json_encode($expected);

        $item = json_decode($jsonString);
        $boardingCard = BoardingCardJsonRepresenter::toDomain($item);
        $this->assertInstanceOf(AirportCard::class, $boardingCard);
        $this->assertEquals($expected['transportationType'], $boardingCard->getTransportationType());
        $this->assertEquals($expected['startDirection'], $boardingCard->getStartDirection());
        $this->assertEquals($expected['endDirection'], $boardingCard->getEndDirection());
        $this->assertEquals($expected['seat'], $boardingCard->getSeatNumber());
        $this->assertEquals($expected['gate'], $boardingCard->getGate());
        $this->assertEquals($expected['luggageInstructions'], $boardingCard->getLuggageInstructions());
        $this->assertEquals($expected['cardNumber'], $boardingCard->getCardNumber());
        $this->assertEquals(
            'From Sofia, take flight 12323BBB to Plovdiv. Gate 1B, seat 1C. Get your luggage from Gate B11',
            $boardingCard->getInstructions()
        );
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     */
    public function testToDomainFails()
    {
        $item = json_decode('{}');
        BoardingCardJsonRepresenter::toDomain($item);
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\NotImplementedException
     */
    public function testToDomainCreatesAirportCardFails()
    {
        $expected = [
            'transportationType' => 'blbala',
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'seat' => '1C',
            'gate' => '1B',
            'luggageInstructions' => 'Get your luggage from Gate B11',
            'cardNumber' => '12323BBB',
        ];
        $jsonString = json_encode($expected);

        $item = json_decode($jsonString);
        BoardingCardJsonRepresenter::toDomain($item);
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     */
    public function testToDomainCreatesBusCard()
    {
        $expected = [
            'transportationType' => BoardingCardType::BUS,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'cardNumber' => '1C',
            'seat' => 'Seat 2d'
        ];
        $jsonString = json_encode($expected);
        $item = json_decode($jsonString);
        $boardingCard = BoardingCardJsonRepresenter::toDomain($item);
        $this->assertInstanceOf(BusStationCard::class, $boardingCard);
        $this->assertEquals($expected['transportationType'], $boardingCard->getTransportationType());
        $this->assertEquals($expected['startDirection'], $boardingCard->getStartDirection());
        $this->assertEquals($expected['endDirection'], $boardingCard->getEndDirection());
        $this->assertEquals($expected['cardNumber'], $boardingCard->getCardNumber());
        $this->assertEquals($expected['seat'], $boardingCard->getSeatNumber());
        $this->assertEquals(
            'Take the bus 1C from Sofia to Plovdiv. Seat 2d',
            $boardingCard->getInstructions()
        );
    }

    /**
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     *
     * @throws NotImplementedException
     */
    public function testToDomainCreatesBusCardFails()
    {
        $expected = [
            'transportationType' => BoardingCardType::BUS,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'seat' => '1C',
            'gate' => '1B',
            'luggageInstructions' => 'Get your luggage from Gate B11',
        ];
        $jsonString = json_encode($expected);

        $item = json_decode($jsonString);
        BoardingCardJsonRepresenter::toDomain($item);
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     */
    public function testToDomainCreatesTrainCard()
    {
        $expected = [
            'transportationType' => BoardingCardType::TRAIN,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'cardNumber' => '1C',
            'seat' => '1'
        ];
        $jsonString = json_encode($expected);
        $item = json_decode($jsonString);
        $boardingCard = BoardingCardJsonRepresenter::toDomain($item);
        $this->assertInstanceOf(TrainStationCard::class, $boardingCard);
        $this->assertEquals($expected['transportationType'], $boardingCard->getTransportationType());
        $this->assertEquals($expected['startDirection'], $boardingCard->getStartDirection());
        $this->assertEquals($expected['endDirection'], $boardingCard->getEndDirection());
        $this->assertEquals($expected['cardNumber'], $boardingCard->getCardNumber());
        $this->assertEquals($expected['seat'], $boardingCard->getSeatNumber());
        $this->assertEquals(
            'Take train 1C, from Sofia to Plovdiv. Sit in seat 1',
            $boardingCard->getInstructions());
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     */
    public function testToDomainCreatesTrainCardFails()
    {
        $expected = [
            'transportationType' => BoardingCardType::TRAIN,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'seat' => '1'
        ];
        $jsonString = json_encode($expected);
        $item = json_decode($jsonString);
        BoardingCardJsonRepresenter::toDomain($item);
    }

    /**
     * @throws MissingArgumentException
     * @throws NotImplementedException
     *
     */
    public function testToDomainCreatesNullCard()
    {
        $expected = [
            'transportationType' => BoardingCardType::NONE,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'cardNumber' => '1C',
            'seat' => '1'
        ];
        $jsonString = json_encode($expected);
        $item = json_decode($jsonString);
        $boardingCard = BoardingCardJsonRepresenter::toDomain($item);
        $this->assertInstanceOf(NullCard::class, $boardingCard);
        $this->assertEquals('', $boardingCard->getStartDirection());
        $this->assertEquals('', $boardingCard->getEndDirection());
        $this->assertEquals('', $boardingCard->getCardNumber());
        $this->assertEquals('', $boardingCard->getSeatNumber());
        $this->assertEquals('You have arrived at your final destination.', $boardingCard->getInstructions());

    }
}