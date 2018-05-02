<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/2/2018
 * Time: 10:43 AM
 */

namespace App\Tests\TravelAdvisor\Domain\Services;


use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class BoardingCardServiceTest extends TestCase
{
    /**
     * @dataProvider providerBoardingCards
     */
    public function testGetFirst()
    {

    }

    public function providerBoardingCards()
    {
        return [
            'dataset 1' => [
                0 => [
                    ''
                ]
            ]
        ];
    }
}