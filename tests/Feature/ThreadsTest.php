<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use  DatabaseMigrations;
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
        $thread=factory('App\Thread')->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }
    
    use  DatabaseMigrations;

/**     @test **/
    public function can_browse_single_thread()
    {
        $thread=factory('App\Thread')->create();
        $response = $this->get('/threads/'.$thread->id);

        $response->assertStatus(200);
    }

/**     @test **/
    public function single_thread_page_shows_title()
    {
        $thread=factory('App\Thread')->create();
        $response = $this->get('/threads/'.$thread->id);

        $response->assertSee($thread->title);
    }

/**     @test **/
    public function single_thread_page_shows_body()
    {
        $thread=factory('App\Thread')->create();
        $response = $this->get('/threads/'.$thread->id);

        $response->assertSee($thread->body);
    }

}
