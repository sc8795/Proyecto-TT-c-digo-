<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccederSoftwareTest extends TestCase
{
    /** * @test */
    function formulario_login_docente(){
        $response=$this->get('/docente');
        $response->assertStatus(200);
        $response->assertViewIs('user_docente.login_docente');
        $response->assertSee('Inicio Sesión');
    }
    /** * @test */
    function formulario_login_student(){
        $response=$this->get('/student');
        $response->assertStatus(200);
        $response->assertViewIs('user_student.login_student');
    }
    /** * @test */
    function formulario_login_admin(){
        $response=$this->get('/administrator');
        $response->assertStatus(200);
        $response->assertViewIs('user_administrador.login_administrador');
    }
    /** * @test */
    function acceder_software_student(){
        //$this->withoutExceptionHandling();
        /*User::create([
            'name'=>'Sergio David',
            'lastname'=>'Cartuche Morocho',
            'password'=>bcrypt('sergiocartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Cuarto',
            'email'=>'sergcart@unl.edu.ec',
        ]);*/
        $response = $this->from('vista_general_student')
            ->post('login_student', [
                'password'=>bcrypt('sergiocartuche'),
                'is_estudiante'=>true,
                'paralelo'=>'A',
                'ciclo'=>'Cuarto',
                'email'=>'sergcart@unl.edu.ec',
            ])->assertRedirect('vista_general_student');

        $this->assertCredentials([
            'password'=>'sergiocartuche',
            'email'=>'sergcart@unl.edu.ec',
        ]);
    }
    /** * @test */
    function acceder_software_docente(){
        //$this->withoutExceptionHandling();
        User::create([
            'name'=>'Luis Antonio',
            'lastname'=>'Chamba Eras',
            'password'=>bcrypt('luischamba'),
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'lachamba@unl.edu.ec',
        ]);
        $response = $this->from('auth_docente')
            ->post('login_docente', [
                'password'=>bcrypt('luischamba'),
                'is_docente'=>true,
                'email'=>'lachamba@unl.edu.ec',
            ])->assertRedirect('auth_docente');

        $this->assertCredentials([
            'password'=>'luischamba',
            'email'=>'lachamba@unl.edu.ec',
        ]);
    }
    /** * @test */
    function acceder_software_admin(){
        //$this->withoutExceptionHandling();
        /*User::create([
            'name'=>'Administrador',
            'lastname'=>'SGT-CIS',
            'password'=>bcrypt('sgtcisadmin'),
            'is_admin'=>true,
            'is_docente'=>false,
            'is_estudiante'=>false,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
            'email'=>'adminsgtcis@unl.edu.ec',
        ]);*/
        $response = $this->from('auth_admin')
            ->post('login_administrador', [
                'password'=>bcrypt('sgtcisadmin'),
                'is_admin'=>true,
                'email'=>'adminsgtcis@unl.edu.ec',
            ])->assertRedirect('auth_admin');

        $this->assertCredentials([
            'password'=>'sgtcisadmin',
            'email'=>'adminsgtcis@unl.edu.ec',
        ]);
    }
}
