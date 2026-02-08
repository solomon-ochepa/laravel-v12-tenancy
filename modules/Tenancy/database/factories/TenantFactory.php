<?php

namespace Modules\Tenancy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Tenancy\app\Models\Tenant;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $prefix = config('tenancy.database.prefix');
        $name = $this->faker->country;

        return [
            'name' => $name,
            'tenancy_db_name' => $prefix.Str::slug($name),
        ];
    }
}
