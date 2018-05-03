<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 11:48 AM
 */

namespace App\TravelAdvisor\Domain\Repository;


use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

interface BoardingCardRepository
{
    /**
     * @return BoardingCardInterface[]
     */
    public function findAll();
}