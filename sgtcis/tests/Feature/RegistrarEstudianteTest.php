<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class RegistrarEstudianteTest extends TestCase
{
    //use RefreshDatabase;
    /*Prueba que presenta el formulario de registro manual del estudiante */
    /** * @test */
    function formulario_registro_estudiante_manual(){
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertSee('Registro estudiante');
    }
    /*Prueba para registrar usuario en la base de datos*/
    /** * @test */
    function registro_estudiante_manual(){
        //$this->withoutExceptionHandling();
        /*User::create([
            'name'=>'Test',
            'lastname'=>'Prueba',
            'password'=>bcrypt('sgtcis12345'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'testprueba@unl.edu.ec',
        ]);*/
        /*enviamos una peticion de tipo post a la url (/) que es en donde se encuentra el formulario
        para el registro manual del estudiante y le enviamos como parametros los datos registrados del
        usuario y luego se redirecciona a una nueva vista que muestra el mensaje de bienvenida al usuario*/
        $response=$this->post('/',[
            'name'=>'Test',
            'lastname'=>'Prueba',
            'password'=>'sgtcis12345',
            'email'=>'testprueba@unl.edu.ec',
        ]);
        /*El metodo assertDatabaseHas permite verificar que el usuario anterior se encuentra registrado
        en la base de datos. Se pasa como primer argumento el nombre de la tabla y como segundo argumento
        los datos que se espera encontrar.*/
        $this->assertCredentials([
            'name'=>'Test',
            'lastname'=>'Prueba',
            'password'=>'sgtcis12345',
            'email'=>'testprueba@unl.edu.ec',
        ]);
    }
    /** * @test */
    function registro_estudiante_google(){
        /*User::create([
            'name'=>'Test',
            'lastname'=>'Prueba google',
            'password'=>bcrypt('sgtcis12345'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'testprueba2@unl.edu.ec',
            'provider'=>strtoupper('GOOGLE'),
            'provider_id'=>'109522965800139895198',
        ]);  */
        $this->assertCredentials([
            'name'=>'Test',
            'lastname'=>'Prueba google',
            'password'=>'sgtcis12345',
            'email'=>'testprueba2@unl.edu.ec',
        ]);
    }
}
