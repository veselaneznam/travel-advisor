<?php
/**
 * Created by PhpStorm.
 * User: vferdinandova
 * Date: 5/1/18
 * Time: 12:08 PM
 */

namespace App\Services;

use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

interface BoardingCardRepresenter
{
    /**
     * @param \stdClass $jsonObject
     * @return BoardingCardInterface
     */
    public static function toDomain(\stdClass $jsonObject) : BoardingCardInterface;
}