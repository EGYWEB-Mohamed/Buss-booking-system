<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace Database\Factories;

use App\Models\Vehicles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VehiclesFactory extends Factory
{
    protected $model = Vehicles::class;

    public function definition(): array
    {
        return [
            'plate_number' => $this->faker->randomNumber(),
            'driver_name'  => $this->faker->name(),
            'max_seats'    => $this->faker->numberBetween(2,12),
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];
    }
}
