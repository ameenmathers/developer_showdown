<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateUserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updates user firstname, lastname, and timezone to new random ones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timezones = ['CET', 'CST', 'GMT+1'];


        User::all()->each(function ($user) use ($timezones) {

            $user->update([
                'firstname' => Str::random(6),
                'lastname' => Str::random(8),
                'timezone' => $timezones[array_rand($timezones)]
            ]);
        });

        $this->info('User information updated.');
    }
}
