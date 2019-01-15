<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        // given we have an authenticted user
        $this->be($user= factory('App\User')->create());
        // and an existing thread
        $thread= factory('App\Thread')->create();
        // when the user adds a reply to the thread
        $reply=factory('App\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray());

        // then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);

    }

    /**
     * @test
     */
    public function unauthenticated_user_may_not_add_reply()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies',['body'=>'foo', 'user_id'=>1]);

    }
}
