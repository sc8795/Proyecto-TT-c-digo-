<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VistaGeneralCuentaTest extends TestCase
{
    /** * @test */
    function vista_cuenta_student(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('vista_general_student');
        $response->assertStatus(200)
            ->assertSee('Vista general de la cuenta');
    }
    /** * @test */
    function vista_cuenta_docente(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('vista_general_docente');
        $response->assertStatus(200)
            ->assertSee('Vista general de la cuenta');
    }
    /** * @test */
    function vista_cuenta_admin(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('vista_general_admin');
        $response->assertStatus(200)
            ->assertSee('Vista general de la cuenta');
    }
}
