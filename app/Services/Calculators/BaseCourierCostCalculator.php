<?php

namespace App\Services\Calculators;

use App\DTO\QuoteDTO;

/**
 * Abstract base class for courier cost calculators.
 */
abstract class BaseCourierCostCalculator implements CalculatorInterface
{
    /**
     * The fixed cost for an extra person.
     */
    const EXTRA_PERSON_COST = 15;

    /**
     * The cost per mile.
     *
     * @var float
     */
    protected float $costPerMile;

    /**
     * The distances between pickup and drop-off locations.
     *
     * @var array
     */
    protected array $distances;

    /**
     * Indicates whether it's a two-person job.
     *
     * @var bool
     */
    protected bool $isTwoPersonJob;

    /**
     * Constructor.
     *
     * @param float $costPerMile The cost per mile.
     * @param array $distances The distances between pickup and drop-off locations.
     * @param bool $isTwoPersonJob Indicates whether it's a two-person job.
     */
    public function __construct(float $costPerMile, array $distances, bool $isTwoPersonJob = false)
    {
        $this->costPerMile = $costPerMile;
        $this->distances = $distances;
        $this->isTwoPersonJob = $isTwoPersonJob;
    }

    /**
     * Calculate the courier cost and return a QuoteDTO.
     *
     * @return QuoteDTO
     */
    public function calculate(): QuoteDTO
    {
        $numDropOffs = $this->calculateNumDropOffs();
        $totalDistance = $this->calculateTotalDistance();
        $extraPersonPrice = $this->calculateExtraPersonPrice();
        $totalPrice = $this->calculateTotalPrice($totalDistance, $extraPersonPrice);

        return new QuoteDTO(
            $numDropOffs,
            $totalDistance,
            $this->costPerMile,
            $extraPersonPrice,
            $totalPrice,
            $this->isTwoPersonJob
        );
    }

    /**
     * Calculate the number of drop-offs.
     *
     * @return int
     */
    protected function calculateNumDropOffs(): int
    {
        return count($this->distances);
    }

    /**
     * Calculate the total distance.
     *
     * @return float
     */
    protected function calculateTotalDistance(): float
    {
        return array_sum($this->distances);
    }

    /**
     * Calculate the extra person price.
     *
     * @return float
     */
    protected function calculateExtraPersonPrice(): float
    {
        return $this->isTwoPersonJob ? self::EXTRA_PERSON_COST : 0;
    }

    /**
     * Calculate the total price.
     *
     * @param float $totalDistance The total distance.
     * @param float $extraPersonPrice The extra person price.
     * @return float
     */
    protected function calculateTotalPrice(float $totalDistance, float $extraPersonPrice): float
    {
        return ($totalDistance * $this->costPerMile) + $extraPersonPrice;
    }
}
