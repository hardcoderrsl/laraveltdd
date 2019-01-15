<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp()
    {
        # code...
        parent::setUp();
        $this->thread= factory("App\Thread")->create();
    }
    /**
     * @test
     */
    public function a_thread_has_reply()
    {   
       
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /**
     * @test 
     * */
    public function thread_has_creator(){
        // $thread= factory("App\Thread")->create();
        $this->assertInstanceOf("App\User",$this->thread->owner);
    }
    /**
     * @test
     */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body'=>'foo',
            'user_id'=>1
        ]);
        $this->assertCount(1,$this->thread->replies);
    }
}
