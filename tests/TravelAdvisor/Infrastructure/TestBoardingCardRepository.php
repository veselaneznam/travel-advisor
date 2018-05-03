<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 5:31 PM
 */

namespace App\Tests\TravelAdvisor\Infrastructure;


use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Repository\BoardingCardRepository;

class TestBoardingCardRepository implements BoardingCardRepository
{

    /**
     * @return BoardingCardInterface[]
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }
}