<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => 'Akinkunmi',
            'last_name' => 'Ajiboye',
            'other_name' => 'Uthman',
            'email' => 'ajakuth@gmail.com',
            'identity_no' => 215007,
            'faculty_id' => '1',
            'department_id' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('Akin_2546'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
