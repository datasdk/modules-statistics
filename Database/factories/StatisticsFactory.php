<?php

namespace Modules\Statistics\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Statistics\Models\Statistics;
use Modules\Statistics\Models\Counter;

class StatisticsFactory extends Factory
{
    protected $model = Statistics::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sorting' => $this->faker->randomNumber(),
            // Associating a Counter model to the statistics
            'counter_id' => Counter::factory(), // Assuming a counter factory exists, otherwise create one
        ];
    }
}
