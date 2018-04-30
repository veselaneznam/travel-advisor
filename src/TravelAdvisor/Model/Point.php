<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:22 AM
 */

namespace App\TravelAdvisor\Model;


interface Point
{
    /**
     * @return Direction
     */
    public function getDirection() : Direction;

    public function getTransportationType() : string;
}