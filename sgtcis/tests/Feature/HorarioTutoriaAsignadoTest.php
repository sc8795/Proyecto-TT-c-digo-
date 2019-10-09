<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HorarioTutoriaAsignadoTest extends TestCase
{
    /** * @test */
    function horario_asignado(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);

        $user_docente=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false,
        ]);
        $response=$this->get("horario_tutoria_asignada_op2/{$user_docente->id}");
        $response->assertStatus(200);
            //->assertSee('');
    }
}
