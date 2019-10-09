<?php

namespace Tests\Feature;

use App\User;
use App\Materia;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarMateriaTest extends TestCase
{
    /** * @test */
    function form_registro_materia(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('registrar_materia');
        $response->assertStatus(200)
            ->assertSee('Registrar materia');
    }
    /** * @test */
    function registro_materia(){
        $user=factory(User::class)->create();
        $this->withoutExceptionHandling();
        $this->actingAs($user);

        $user_docente=factory(User::class)->create([
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);

        $materia=factory(Materia::class)->create([
            'usuario_id'=>$user_docente->id,
        ]);

        $this->from('materias_registradas')->post('crear_materia',[
            'docente' => $materia->usuario_id,
            'name'=>$materia->name,
            'gender' => $materia->ciclo,
            'paralelo'=>$materia->paralelo
        ])->assertRedirect('materias_registradas');
    }
}
