<?php

namespace App\Services\Calculators;

use App\DTO\QuoteDTO;

/**
 * Interface for courier cost calculators.
 */
interface CalculatorInterface
{
    /**
     * Calculate the courier cost and return a QuoteDTO.
     *
     * @return QuoteDTO
     */
    public function calculate(): QuoteDTO;
}
