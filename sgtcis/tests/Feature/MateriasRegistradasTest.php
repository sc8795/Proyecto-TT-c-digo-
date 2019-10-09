<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MateriasRegistradasTest extends TestCase
{
    /** * @test */
    function materias_registradas(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('materias_registradas');
        $response->assertStatus(200)
            ->assertSee('Materias registradas');
    }
}
