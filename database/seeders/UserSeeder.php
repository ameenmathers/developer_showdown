<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $timezones = ['CET', 'CST', 'GMT+1'];

        User::factory(20)->create()->each(function ($user) use ($timezones) {
            $user->update([
                'timezone' => $timezones[array_rand($timezones)]
            ]);
        });
    }
}
