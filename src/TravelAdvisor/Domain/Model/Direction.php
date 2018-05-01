<?php
/**
 * Created by PhpStorm.
 * User: Vesela.Ferdinandova
 * Date: 4/30/2018
 * Time: 11:29 AM
 */

namespace App\TravelAdvisor\Domain\Model;


use App\TravelAdvisor\Domain\Exceptions\MissingArgumentException;
use App\TravelAdvisor\Domain\Values\Coordinate;

class Direction
{
    const EARTH_RADIUS = 6371000;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Coordinate
     */
    private $coordinates;

    /**
     * Direction constructor.
     * @param string $name
     * @param Coordinate $coordinates
     */
    private function __construct(string $name, Coordinate $coordinates = null)
    {
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    /**
     * @param $jsonObject
     * @return Direction
     * @throws MissingArgumentException
     */
    public static function createFromJson($jsonObject)
    {
        if (!property_exists('name', $jsonObject)) {
            throw new MissingArgumentException('Missing property name', 400);
        }
        if (!property_exists('coordinates', $jsonObject)) {
            $coordinate = null;
        }

        $coordinate = new Coordinate($jsonObject->coordinates->latitude, $jsonObject->coordinates->longitude);

        return new Direction($jsonObject->name, $coordinate);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinates(): Coordinate
    {
        return $this->coordinates;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'coordinates' => [
                'latitude' => $this->coordinates->getLatitude(),
                'longitude' => $this->coordinates->getLongitude()
            ]
        ];
    }

    /**
     * @param Direction $direction
     * @return float|int
     */
    public function calculateDistance(Direction $direction)
    {
        $latFrom = deg2rad($this->coordinates->getLatitude());
        $lonFrom = deg2rad($this->coordinates->getLongitude());
        $latTo = deg2rad($direction->getCoordinates()->getLatitude());
        $lonTo = deg2rad($direction->getCoordinates()->getLongitude());

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * self::EARTH_RADIUS;

    }
}