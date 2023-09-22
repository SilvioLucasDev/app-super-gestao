<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->jobTitle(),
            'descricao' => fake()->text(50),
            'peso' => fake()->numberBetween(0, 100),
            'unidade_id' => fake()->numberBetween(1, 1),
        ];
    }
}
