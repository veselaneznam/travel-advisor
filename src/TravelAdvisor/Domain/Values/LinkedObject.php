<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 5/2/2018
 * Time: 9:45 AM
 */

namespace App\TravelAdvisor\Domain\Values;


use App\TravelAdvisor\Domain\Model\BoardingCardInterface;

class LinkedObject
{
    private $value;
    private $prev;
    private $next;

    /**
     * LinkedObject constructor.
     * @param $value
     * @param null $prev
     * @param null $next
     */
    public function __construct(BoardingCardInterface $value, $prev = null, $next = null)
    {
        $this->value = $value;
        $this->prev = $prev;
        $this->next = $next;
    }

    /**
     * @param LinkedObject $insertee
     */
    public function append(LinkedObject $insertee)
    {
        $link = $this;
        while($link->next != null && $insertee->prev == $link->next) {
            $link = $link->next;

        }
        $link->next = $insertee;
        $insertee->prev = $link;
    }

    /**
     * @return BoardingCardInterface
     */
    public function getValue(): BoardingCardInterface
    {
        return $this->value;
    }

    /**
     * @return null
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @return null
     */
    public function getNext()
    {
        return $this->next;
    }

    public function toArray()
    {
        $array = [$this->value];
        while($this->next != null) {
            $array[] = $this->next;
        }

        return $array;
    }
}