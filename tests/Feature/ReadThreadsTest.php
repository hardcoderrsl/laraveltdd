<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use  DatabaseMigrations;

    // setup function works as default function called each time before any testcase executes
    public function setUp(){
        parent::setUp();
        $this->thread=factory('App\Thread')->create();
    }
/**     @test **/
    public function user_can_browse_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
    use  DatabaseMigrations;
/**     @test **/
    public function title_appears_in_index_view()
    {
        
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }
    
    use  DatabaseMigrations;

/**     @test **/
    public function can_browse_single_thread()
    {
        
        $response = $this->get($this->thread->path());

        $response->assertStatus(200);
    }

/**     @test **/
    public function single_thread_page_shows_title()
    {
       
        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->title);
    }

/**     @test **/
    public function single_thread_page_shows_body()
    {
       
        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->body);
    }
    

/**     @test **/
    public function user_can_read_replies_that_are_associated_with_a_thread()
    {
    //    given we have a thread which we are having from setUp()

    // and that thread includes reply
       $reply= factory("App\Reply")
        ->create(["thread_id"=>$this->thread->id]);
    // when we visit a thread
        $response = $this->get($this->thread->path());

    // then we should see the replies
        $response->assertSee($reply->body);
    }

}
