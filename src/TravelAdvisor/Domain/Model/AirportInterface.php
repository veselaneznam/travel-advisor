<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/3/2018
 * Time: 2:45 PM
 */

namespace App\TravelAdvisor\Domain\Model;


interface AirportInterface
{
    /**
     * @return string
     */
    public function getLuggageInstructions() : string;

    /**
     * @return string
     */
    public function getGate() : string ;
}