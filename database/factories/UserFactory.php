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
        $first = fake()->firstName();
        $last  = fake()->lastName();
        return [
            'name' => "$first $last",
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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

    /**
     * Genera first_name y last_name sin prefijos y crea Profile.
     */
    public function configure(): self
    {
        return $this->afterCreating(function (User $user) {
            [$first, $last] = explode(' ', $user->name, 2);
            $user->profile()->update([
                'first_name' => $first,
                'last_name'  => $last,
                'phone'      => fake()->phoneNumber(),
                'address'    => fake()->address(),
                'birthday'   => fake()->date(),
                'bio'        => fake()->text(),
            ]);
        });
    }
}
