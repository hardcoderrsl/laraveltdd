<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *@test
     */
    public function an_authenticated_user_can_create_forum_threads()
    {
        // given we have a signed in user
            $this->actingAs(factory('App\User')->create()); 
        // when we hit an end point to create a new thread
            $thread=factory('App\Thread')->make();
            $this->post('/threads', $thread->toArray());
        // then, we visiti a new page
           $response= $this->get($thread->path());
        // we should see the new thread
            $response->assertSee($thread->title)
                ->assertSee($thread->body);
    }
    /**
     * @test
     */

    public function guest_user_may_not_create_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread=factory('App\Thread')->make();
        $this->post('/threads', $thread->toArray());
   
    }
}
