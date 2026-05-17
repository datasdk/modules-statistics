<?php

namespace Modules\Statistics\Http\Requests;

use Orion\Http\Requests\Request;

class StatisticsRequest extends Request
{
    // Validation rules for creating a new statistics record
    public function storeRules(): array
    {
        return [
            "title" => "required",
            "description" => "sometimes",
            "categories" => "sometimes|nullable|array",
            "categories.*" => "sometimes|int|exists:categories,id",
        ];
    }

    // Validation rules for updating an existing statistics record
    public function updateRules(): array
    {
        return [
            "title" => "required",
            "description" => "sometimes",
            "categories" => "sometimes|nullable|array",
            "categories.*" => "sometimes|int|exists:categories,id",
        ];
    }
}
