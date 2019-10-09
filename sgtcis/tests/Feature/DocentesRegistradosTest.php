<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocentesRegistradosTest extends TestCase
{
    /** * @test */
    function docentes_registrados(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('docentes_registrados');
        $response->assertStatus(200)
            ->assertSee('Docentes registrados');
    }
}
