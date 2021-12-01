<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\visitor;

class VisitorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_visitors()
    {
        $response = $this->get('/visitors');
        $response->assertOk();

        $response->assertViewIs('visitors.index');
        $expectedPage1NameData = Visitor::orderBy('created_at', 'desc')
        ->take(20)
        ->pluck('comments');
        
        $response->assertSeeInOrder(array_merge([
            'All of our visitors'
        ],
        $expectedPage1NameData->toArray()));


    }

    public function test_update_visitors()
    {
        $newComments = 'Some test comments';
        $visitor = Visitor::factory()->create();

        $response = $this->actingAs($visitor->user)
        ->followingRedirects()
        ->patch("/visitors/{$visitor->id}", [
            'comments' => $newComments
        ]);
        
        $newVisitor = $visitor->fresh();

        $response->assertOk();
        $this->assertEquals($newComments, $newVisitor->comments);
    }

    public function test_update_visitors_wrong_user() {

        $newComments = 'Some test comments';
        $visitor = Visitor::factory()->create();   
        $wrongUser = User::factory()->create();
            
        $response = $this->actingAs($wrongUser)
        ->followingRedirects()
        ->patch("/visitors/{$visitor->id}", [
        'comments' => $newComments
        ]);
        
        $newVisitor = $visitor->fresh();
        
        $response->assertUnauthorized();
        $this->assertNotEquals($newComments, $newVisitor->comments);
    }


    //Self-directed work
    //Testing the create method in the visitor controller 
    public function test_create_visitor_signing(){

        $response = $this->get('/visitors/create');
        $response->assertOk();
        $response->assertViewIs('visitors.create');

        $newComments = 'Some test comments for create';

        $visitor = Visitor::factory()->create();

        $response = $this->actingAs($visitor->user)
        ->followingRedirects()
        ->patch("/visitors/create", [
            'comments' => $newComments
        ]);

        $newVisitor = $visitor->fresh();

        $this->assertEquals($newComments, $newVisitor->comments);



        /*
        $expectedNewData = Visitor::orderBy('created_at', 'desc')
        ->take(1)
        ->pluck('comments');
        */
        
    }




}
