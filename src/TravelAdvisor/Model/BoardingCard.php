<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:14 AM
 */

namespace App\TravelAdvisor\Model;


class BoardingCard implements BoardingCardInterface
{
    public function __construct(Point $pointA, Point $pointB, Seat $seat)
    {
    }
}