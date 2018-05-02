<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/2/2018
 * Time: 10:43 AM
 */

namespace App\Tests\TravelAdvisor\Domain\Services;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Exceptions\NotImplementedException;
use App\TravelAdvisor\Domain\Services\BoardingCardJsonRepresenter;
use App\TravelAdvisor\Domain\Services\BoardingCardService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class BoardingCardServiceTest extends TestCase
{
    /**
     * @dataProvider providerBoardingCardsGetFirst
     * @param $jsonString
     * @param $expectedResult
     * @throws MissingArgumentException
     * @throws NotImplementedException
     */
    public function testGetFirst($jsonString, $expectedResult)
    {
        $requestBody = json_decode($jsonString);
        $unsortedBoardingCards = [];
        foreach ($requestBody as $item) {
            $unsortedBoardingCards[] = BoardingCardJsonRepresenter::toDomain($item);
        }

        $boardingcardService = new BoardingCardService();
        list($firstElement, $key) = $boardingcardService->getFirst($unsortedBoardingCards);
        $this->assertEquals($expectedResult, $firstElement->toArray());
    }

    /**
     * @expectedException \App\TravelAdvisor\Domain\Exceptions\MissingArgumentException
     */
    public function testGetFirstFail()
    {
        $requestBody = json_decode('{}');
        $unsortedBoardingCards = [];
        foreach ($requestBody as $item) {
            $unsortedBoardingCards[] = BoardingCardJsonRepresenter::toDomain($item);
        }

        $boardingcardService = new BoardingCardService();
        list($firstElement, $key) = $boardingcardService->getFirst($unsortedBoardingCards);

    }

    /**
     * @param $jsonString
     *
     * @param $expected
     * @throws MissingArgumentException
     * @throws NotImplementedException
     * @dataProvider providerBoardingCards
     */
    public function testSort($jsonString, $expected)
    {
        $requestBody = json_decode($jsonString);
        $unsortedBoardingCards = [];
        foreach ($requestBody as $item) {
            $unsortedBoardingCards[] = BoardingCardJsonRepresenter::toDomain($item);
        }
        $boardingcardService = new BoardingCardService();

        $sortedBordingCards = $boardingcardService->sort($unsortedBoardingCards);

        $this->assertEquals($expected, $sortedBordingCards);
    }

    public function providerBoardingCardsGetFirst()
    {
        return [
            'dataset 1 get first with sorted cards' => [
                'jsonString' => file_get_contents(__DIR__ . '/data/sorted_cards.json'),
                'expectedResult' => [
                    'instructions' => 'Take the bus from Bus Station to Sofia Airport. No seat assignment.'
                ]
            ],

            'dataset 2 get first with unsorted cards' => [
                'jsonString' => file_get_contents(__DIR__ . '/data/unsorted_cards.json'),
                'expectedResult' => [
                    'instructions' => 'Take the bus from Bus Station to Sofia Airport. No seat assignment.'
                ]
            ]
        ];
    }

    public function providerBoardingCards()
    {
        return [
            'dataset 1 sorted list' => [
                'jsonString' => file_get_contents(__DIR__ . '/data/sorted_cards.json'),
                'expected' => array (
                    0 => '{"instructions":"Take the bus from Bus Station to Sofia Airport. No seat assignment."}',
                    1 => '{"instructions":"From Sofia, take flight 12323BBB to Plovdiv Aiport. Gate 1C, seat Get your luggage from Gate B11"}',
                    2 => '{"instructions":"Take the bus from Plovdiv Aiport to Plovdiv Train Station. No seat assignment."}',
                    3 => '{"instructions":"Take train 12WE, from Plovdiv Train Station to Burgas. Sit in seat 1C"}',
                    4 => '{"instructions":"You have arrived at your final destination."}',
                )
            ],
            'dataset 2 unsorted list' => [
                'jsonString' => file_get_contents(__DIR__ . '/data/unsorted_cards.json'),
                'expected' => array (
                    0 => '{"instructions":"Take the bus from Bus Station to Sofia Airport. No seat assignment."}',
                    1 => '{"instructions":"From Sofia, take flight 12323BBB to Plovdiv Aiport. Gate 1C, seat Get your luggage from Gate B11"}',
                    2 => '{"instructions":"Take the bus from Plovdiv Aiport to Plovdiv Train Station. No seat assignment."}',
                    3 => '{"instructions":"Take train 12WE, from Plovdiv Train Station to Burgas. Sit in seat 1C"}',
                    4 => '{"instructions":"You have arrived at your final destination."}',
                )
            ],
            'dataset 3 unsorted list' => [
                'jsonString' => file_get_contents(__DIR__ . '/data/missing_none_card.json'),
                'expected' => array (
                    0 => '{"instructions":"Take the bus from Bus Station to Sofia Airport. No seat assignment."}',
                    1 => '{"instructions":"From Sofia, take flight 12323BBB to Plovdiv Aiport. Gate 1C, seat Get your luggage from Gate B11"}',
                    2 => '{"instructions":"Take the bus from Plovdiv Aiport to Plovdiv Train Station. No seat assignment."}',
                    3 => '{"instructions":"Take train 12WE, from Plovdiv Train Station to Burgas. Sit in seat 1C"}',
                )
            ]
        ];
    }
}