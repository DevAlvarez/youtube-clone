<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //USERS
        $user1 = User::factory()->create([
            
            'email' => 'john@doe.com'
        ]);

        $user2 = User::factory()->create([
            
            'email' => 'jane@doe.com'
        ]);

        //CHANNELS WITH USERS

        $channel1 = Channel::factory()->create([
            
            'user_id' => $user1->id
        ]);

        $channel2 = Channel::factory()->create([
            'user_id' => $user2->id
        ]);

        //SUBSCRIPTIONS TO CHANNELS

        $channel1->subscriptions()->create([
            'user_id' => $user2->id
        ]);

        $channel2->subscriptions()->create([
            'user_id' => $user1->id
        ]);

        ////
        Subscription::factory(10000)->create([
            'channel_id' => $channel1->id
        ]);

        Subscription::factory(10000)->create([
            'channel_id' => $channel2->id
        ]);

    }
}