<?php

namespace Tests\Feature;

use App\User;
use App\Materia;
use App\Solitutoria;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitacionTutoriaTest extends TestCase
{
    /** * @test */
    function invitacion_tutoria(){
        $user=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true
        ]);
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('solicitar_tutoria');
        $response->assertStatus(200);

        $response=$this->post("vista_solicitar_tutoria",[

        ]);
        
        $user_docente=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);

        $materia=factory(Materia::class)->create([
            'usuario_id'=>$user_docente->id,
        ]);

        $horario=factory(Solitutoria::class)->create([
            'materia_id'=>$materia->id,
            'docente_id'=>$materia->usuario_id,
            'estudiante_id'=>$user->id,
            'tipo'=>'grupal'
        ]);
    }
}
