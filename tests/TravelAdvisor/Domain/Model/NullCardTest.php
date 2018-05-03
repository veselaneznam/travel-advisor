<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 10:38 AM
 */

namespace App\Tests\TravelAdvisor\Domain\Model;

use App\TravelAdvisor\Domain\Model\NullCard;
use PHPUnit\Framework\TestCase;

class NullCardTest extends TestCase
{
    public function testCreationFromJson()
    {
        $jsonString = '{"test":"justTest"}';
        $nullCard = NullCard::createFromJson(json_decode($jsonString));
        $this->assertInstanceOf(NullCard::class, $nullCard);
        $this->assertInstanceOf(NullCard::class, $nullCard->getPrev([]));
        $this->assertInstanceOf(NullCard::class, $nullCard->getNext([]));
        $this->assertEquals('', $nullCard->getStartDirection());
        $this->assertEquals('', $nullCard->getEndDirection());
        $this->assertEquals('', $nullCard->getSeatNumber());
        $this->assertEquals('', $nullCard->getCardNumber());
        $this->assertEquals('You have arrived at your final destination.', $nullCard->getInstructions());
    }

    public function testCreationFromJsonWitNoData()
    {
        $nullCard = NullCard::createFromJson();
        $this->assertInstanceOf(NullCard::class, $nullCard);
        $this->assertInstanceOf(NullCard::class, $nullCard->getPrev([]));
        $this->assertInstanceOf(NullCard::class, $nullCard->getNext([]));
        $this->assertEquals('', $nullCard->getStartDirection());
        $this->assertEquals('', $nullCard->getEndDirection());
        $this->assertEquals('', $nullCard->getSeatNumber());
        $this->assertEquals('', $nullCard->getCardNumber());
        $this->assertEquals('You have arrived at your final destination.', $nullCard->getInstructions());
    }
}