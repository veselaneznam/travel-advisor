<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 1:59 PM
 */

namespace App\Tests\TravelAdvisor\Domain\Model;

use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Model\AirportCard;
use App\TravelAdvisor\Domain\Model\BusStationCard;
use App\TravelAdvisor\Domain\Values\BoardingCardType;
use PHPUnit\Framework\TestCase;

class BusCardTest extends TestCase
{
    /**
     * @var array
     */
    private $data;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->data = json_decode(file_get_contents(__DIR__ . '/data/unsorted_cards.json'));
    }

    /**
     * @throws MissingArgumentException
     */
    public function testCreationFromJson()
    {

        $boardingCard = BusStationCard::createFromJson($this->data[0]);
        $this->assertInstanceOf(BusStationCard::class, $boardingCard);
        $this->assertEquals('Plovdiv Aiport', $boardingCard->getStartDirection());
        $this->assertEquals('Plovdiv Train Station', $boardingCard->getEndDirection());
        $this->assertEquals('No seat assignment.', $boardingCard->getSeatNumber());
        $this->assertEquals('C1', $boardingCard->getCardNumber());
        $this->assertEquals('bus', $boardingCard->getTransportationType());

        $this->assertEquals(
            'Take the bus C1 from Plovdiv Aiport to Plovdiv Train Station. No seat assignment.',
            $boardingCard->getInstructions()
        );
    }

    /**
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     */
    public function testCreationFromJsonWitWrongData()
    {
        AirportCard::createFromJson($this->data[4]);
    }

    /**
     * @throws MissingArgumentException
     */
    public function testToArrayBusCard()
    {
        $expected = [
            'transportationType' => BoardingCardType::BUS,
            'startDirection' => 'Sofia',
            'endDirection' => 'Plovdiv',
            'cardNumber' => '1C',
            'seat' => 'Seat 1'
        ];
        $jsonString = json_encode($expected);
        $item = json_decode($jsonString);
        $boardinCard = BusStationCard::createFromJson($item);
        $this->assertEquals(
            ["instructions" => "Take the bus 1C from Sofia to Plovdiv. Seat 1"],
            $boardinCard->toArray()
        );
    }
}