<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:22 AM
 */

namespace App\TravelAdvisor\Domain\Values;


class Seat
{
    /**
     * @var int
     */
    private $number;
    /**
     * @var string
     */
    private $letter;
    /**
     * @var string
     */
    private $side;

    /**
     * Seat constructor.
     * @param int $number
     * @param string $letter
     * @param string $side
     */
    public function __construct(int $number, string $letter, string $side)
    {
        $this->number = $number;
        $this->letter = $letter;
        $this->side = $side;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->side . ' ' . $this->number . $this->letter;
    }

    /**
     * @return string
     */
    public function getSide(): string
    {
        return $this->side;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getLetter(): string
    {
        return $this->letter;
    }
}