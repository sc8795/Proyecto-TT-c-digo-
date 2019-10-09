<?php

namespace Tests\Feature;

use App\User;
use App\Horario;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AsignarHorarioTutoriaTest extends TestCase
{
    /** * @test */
    function asignar_horario_tutoria(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('asignar_horario_tutoria');
        $response->assertStatus(200);

        $user_docente=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);

        $response=$this->post("asignar_horario_docente/$user_docente->id",[

        ]);

        $response=$this->post("asignar_horario/$user_docente->id",[

        ]);

        $horario=factory(Horario::class)->create([
            'usuario_id'=>$user_docente->id
        ]);
    }
}
