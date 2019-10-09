<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrarDocenteTest extends TestCase
{
    /** * @test */
    function form_registro_docente(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('registrar_docente');
        $response->assertStatus(200)
            ->assertSee('Registrar docente');
    }
    /** * @test */
    function registro_docente(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);

        $this->from('docentes_registrados')->post('crear_docente',[
            'name'=>'Luis',
            'lastname'=>'Chamba',
            'password'=>'luischamba',
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'luisantonio@unl.edu.ec'
        ])->assertRedirect('docentes_registrados');
    }
}
