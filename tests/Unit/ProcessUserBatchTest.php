<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProcessUserBatchTest extends TestCase
{

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_batch_user_request()
    {


        Cache::put('users_to_update', [
            [
                'email' => 'alex@acme.com',
                'firstname' => 'Alex',
                'lastname' => 'Random',
                'timezone' => 'CST'
            ],
            [
                'email' => 'hellen@acme.com',
                'firstname' => 'Hellen',
                'lastname' => 'Random',
                'timezone' => 'GMT'
            ]
        ], now()->addMinutes(10));

        Http::fake([
            'https://thirdparty-api.com/update' => Http::response(['status' => 'success'], 200)
        ]);


        $this->artisan('users:process-batch')
            ->expectsOutput('Batch processed successfully.')
            ->assertExitCode(0);

        Http::assertSent(function ($request) {
            return $request->url() == 'https://thirdparty-api.com/update' &&
                $request['batches'][0]['subscribers'][0]['email'] == 'alex@acme.com' &&
                $request['batches'][0]['subscribers'][0]['time_zone'] === 'CST';
        });
    }
}
