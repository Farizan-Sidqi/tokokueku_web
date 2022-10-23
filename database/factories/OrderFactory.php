<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'total_qty' => null,
            'total_harga' => null,
            'catatan' => fake()->sentence(4),
            'alamat_antar' => fake()->address(),
            'tgl_order' => null,
            'status' => 'dipesankan',
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}
