<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistroTutoriasSolicitadasTest extends TestCase
{
    /** * @test */
    function registro_tut_solicitadas(){
        $user=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true
        ]);
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('vista_tut_sol');
        $response->assertStatus(200)
            ->assertSee('Registro de tutorías');
    }
}
