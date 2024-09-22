<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ProcessUserBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'users:process-batch';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process batches of users whose attributes have changed';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $usersToUpdate = Cache::pull('users_to_update', []);

        if (empty($usersToUpdate)) {
            $this->info('No users to update.');
            return;
        }


        $batches = array_chunk($usersToUpdate, 1000);

        foreach ($batches as $batch) {

            $subscribers = [];

            foreach ($batch as $user) {

                $subscribers[] = [
                    'email' => $user['email'],
                    'name' => $user['firstname'] . ' ' . $user['lastname'],
                    'time_zone' => $user['timezone'],
                ];
            }

            $payload = [
                'batches' => [
                    [
                        'subscribers' => $subscribers
                    ]
                ]
            ];


            $response = Http::post('https://thirdparty-api.com/update', $payload);

            if ($response->successful()) {
                $this->info('Batch processed successfully.');
            } else {
                $this->error('Failed to process batch.');
            }

            sleep(3600 / 50);
        }
    }
}
