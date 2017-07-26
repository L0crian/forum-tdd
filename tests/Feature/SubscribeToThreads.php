<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscribeToThreads extends TestCase
{
    use DatabaseMigrations;

    /** test */
    public function a_user_can_subscribe_to_test()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->post($thread->path() . '/subscriptions');

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply here'
        ]);

        $thread->assertCount(1, auth()->user()->notifications);
    }
}
