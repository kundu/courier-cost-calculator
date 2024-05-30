<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Services\Calculators\CourierCostCalculator;

/**
 * Controller for handling delivery-related operations.
 */
class DeliveryController extends Controller
{
    /**
     * Get a quote for a delivery job.
     *
     * @param QuoteRequest $request The request containing the quote parameters.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the quote data.
     */
    public function getQuote(QuoteRequest $request)
    {
        $calculator = new CourierCostCalculator($request->input('cost_per_mile'),$request->input('distances'), $request->input('is_two_person_job', false));
        $quote = $calculator->calculate();

        return apiResponse(200, 'Quote retrieved successfully', [
            "quote_data" => [
                'num_drop_offs' => $quote->numDropOffs,
                'total_distance' => $quote->totalDistance,
                'cost_per_mile' => $quote->costPerMile,
                'extra_person_price' => $quote->extraPersonPrice,
                'total_price' => $quote->totalPrice,
                'is_two_person_job' => $quote->isTwoPersonJob,
            ]
        ]);
    }
}
