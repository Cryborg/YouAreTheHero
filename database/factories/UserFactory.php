<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password = 'aaaaaaaa'
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Temporary state for not logged in players
     *
     * @return \Database\Factories\UserFactory
     */
    public function temporary(): UserFactory
    {
        return $this->state(function () {
            return [
                'valid_from' => Date::now(),
                'role' => 'temp',
            ];
        });
    }
}
