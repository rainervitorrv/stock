<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_fantasy' => $this->faker->company(),
            'business_name' => null,
            'type' => $type = $this->faker->randomElement(['PF', 'PJ']),
            'cpf_cnpj' => $type === 'PF'
                ? $this->faker->numerify('###.###.###-##') //CPF
                : $this->faker->numerify('##.###.###/####-##'), //CNPJ
            'cep' => $this->faker->postcode(),
            'address' => $this->faker->address(),
            'number' => $this->faker->buildingNumber(),
            'complement' => null,
            'neighborhood' => $this->faker->streetAddress(),
            'city' =>$this->faker->city(),
            'state' => $this->faker->state(),
            'country' => 'Brasil',
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
