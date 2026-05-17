<?php

namespace Modules\Statistics\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Statistics\Models\Statistics;
use Modules\Statistics\Models\User;
use Modules\Statistics\Http\Requests\StatisticsRequest;
use Orion\Http\Requests\Request;
use App\Http\Controllers\OrionBaseController;

class StatisticsController extends OrionBaseController
{
    public $model = Statistics::class;

    protected $request = StatisticsRequest::class;

    public $includes = [
        // Fjernet "counter" relaterede includes
        "votes"
    ];

    public function store(Request $req)
    {
        // Hent data fra request
        $title = $req->title;
        $description = $req->description;
        $categories = $req->categories;

        // Opret statistik
        $stats = Statistics::create([
            "title" => $title,
            "description" => $description
        ]);

        // Sæt kategorier hvis de findes
        if ($req->has("categories")) {
            $stats->setCategories($categories);
        }

        return $stats->refresh();
    }

    public function update(Request $req, ...$args)
    {
        // Hent data fra request
        $title = $req->title;
        $description = $req->description;
        $categories = $req->categories;
        $id = $args[0];

        // Find statistik
        $stats = Statistics::findOrFail($id);

        // Opdater
        $stats->update([
            "title" => $title,
            "description" => $description
        ]);

        // Opdater kategorier hvis de findes
        if ($req->has("categories")) {
            $stats->setCategories($categories);
        }

        return $stats->refresh();
    }
}
