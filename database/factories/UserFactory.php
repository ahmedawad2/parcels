<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
        ];
    }

    public function sender()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 1
            ];
        });
    }

    public function biker()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 2
            ];
        });
    }
}
