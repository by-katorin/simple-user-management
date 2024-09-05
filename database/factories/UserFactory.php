<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prefixname' => fake()->optional()->title,
            'firstname' => fake()->firstName,
            'middlename' => fake()->optional()->firstName,
            'lastname' => fake()->lastName,
            'suffixname' => fake()->optional()->suffix,
            'username' => fake()->unique()->userName,
            'email' => fake()->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'photo' => fake()->imageUrl(360, 360, 'animals', true), 
            'type' => fake()->randomElement(['admin', 'user', 'moderator', 'guest']), 
            'remember_token' => Str::random(10),
            'name' => function ($attributes) {
                return $attributes['firstname'] . ' ' . $attributes['lastname'];
            }
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('user');
        });
    }
}
