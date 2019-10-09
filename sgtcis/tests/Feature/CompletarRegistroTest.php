<?php

namespace Tests\Feature;

use App\User;
use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompletarRegistroTest extends TestCase
{
    /** * @test */
    function formulario_completar_registro(){
        /*La ruta login_student contiene el formulario para completar registro, cuando
        el estudiante tiene como argumento los parámetros enviados */
        $response = $this->from('login_student')
            ->post('login_student', [
                'password'=>bcrypt('andresmorocho'),
                'is_estudiante'=>true,
                'paralelo'=>'NA',
                'ciclo'=>'NA',
                'email'=>'andresmorocho@unl.edu.ec',
            ])->assertRedirect('login_student');

        $this->assertCredentials([
            'password'=>'andresmorocho',
            'is_estudiante'=>true,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'andresmorocho@unl.edu.ec',
        ]);
    }
    /** * @test */
    function completar_registro(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $this->put('save_completar_registro',[
            'paralelo'=>'A',
            'ciclo'=>'Primero',
            'password'=>'sgtcis12345'
        ])->assertRedirect('auth_student');
    }
}
