<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function a_thread_has_reply()
    {   
        $thread= factory("App\Thread")->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
    }

    /**
     * @test 
     * */
    public function thread_has_creator(){
        $thread= factory("App\Thread")->create();
        $this->assertInstanceOf("App\User",$thread->owner);
    }
}
