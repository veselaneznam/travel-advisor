<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 5:04 PM
 */

namespace App\TravelAdvisor\Infrastructure\Json;

use App\TravelAdvisor\Domain\Model\BoardingCardInterface;
use App\TravelAdvisor\Domain\Repository\BoardingCardRepository;

class JsonBoardingCardRepository implements BoardingCardRepository
{

    /**
     * @return BoardingCardInterface[]
     */
    public function findAll()
    {
        $jsonString = file_get_contents(__DIR__ .'/cards.json');
        return json_decode($jsonString);
    }
}