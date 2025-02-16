<?php
// database/factories/StockTransactionFactory.php
namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockTransactionFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['Masuk', 'Keluar']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => $this->faker->randomElement(['Pending', 'Diterima', 'Ditolak', 'Dikeluarkan']),
            'notes' => $this->faker->sentence()
        ];
    }
}