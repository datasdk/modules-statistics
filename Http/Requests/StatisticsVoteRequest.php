<?php

namespace Modules\Statistics\Http\Requests;

use Orion\Http\Requests\Request;

class StatisticsVoteRequest extends Request
{
    // Validation rules for creating a new vote
    public function storeRules(): array
    {
        return [
            "statistic_id" => "required|exists:statistics,id",
            "vote" => "required",
            "comment" => "sometimes"
        ];
    }

    // Validation rules for updating an existing vote
    public function updateRules(): array
    {
        return [
            "statistic_id" => "required|exists:statistics,id",
            "vote" => "required",
            "comment" => "sometimes"
        ];
    }

    // Validation rules for deleting a vote
    public function deleteRules(): array
    {
        return [
            "statistic_id" => "required|string",
            "vote" => "required",
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'statistic_id.required' => 'Angiv venligst en valgmulighed.',
            'statistic_id.exists'   => 'Den valgte valgmulighed findes ikke.',
            'vote.required'         => 'En stemme er påkrævet.',
        ];
    }
}
