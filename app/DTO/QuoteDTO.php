<?php

namespace App\DTO;

/**
 * Data Transfer Object (DTO) representing a quote for a courier service.
 */
class QuoteDTO
{
    /**
     * The number of drop-off locations.
     *
     * @var int
     */
    public int $numDropOffs;

    /**
     * The total distance to be traveled.
     *
     * @var float
     */
    public float $totalDistance;

    /**
     * The cost per mile.
     *
     * @var float
     */
    public float $costPerMile;

    /**
     * The price for an extra person, if applicable.
     *
     * @var float
     */
    public float $extraPersonPrice;

    /**
     * The total price for the courier service.
     *
     * @var float
     */
    public float $totalPrice;

    /**
     * Indicates whether it's a two-person job.
     *
     * @var bool
     */
    public bool $isTwoPersonJob;

    /**
     * Constructor for the QuoteDTO.
     *
     * @param int $numDropOffs The number of drop-off locations.
     * @param float $totalDistance The total distance to be traveled.
     * @param float $costPerMile The cost per mile.
     * @param float $extraPersonPrice The price for an extra person, if applicable.
     * @param float $totalPrice The total price for the courier service.
     * @param bool $isTwoPersonJob Indicates whether it's a two-person job.
     */
    public function __construct(
        int $numDropOffs,
        float $totalDistance,
        float $costPerMile,
        float $extraPersonPrice,
        float $totalPrice,
        bool $isTwoPersonJob
    ) {
        $this->numDropOffs = $numDropOffs;
        $this->totalDistance = $totalDistance;
        $this->costPerMile = $costPerMile;
        $this->extraPersonPrice = $extraPersonPrice;
        $this->totalPrice = $totalPrice;
        $this->isTwoPersonJob = $isTwoPersonJob;
    }
}
