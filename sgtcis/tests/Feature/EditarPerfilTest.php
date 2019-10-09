<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditarPerfilTest extends TestCase
{
    /** * @test */
    function form_edit_perfil_student(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('editar_perfil_student');
        $response->assertStatus(200)
            ->assertSee('Editar perfil');
    }
    /** * @test */
    function form_edit_perfil_docente(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('editar_perfil_docente');
        $response->assertStatus(200)
            ->assertSee('Editar perfil');
    }
    /** * @test */
    function form_edit_perfil_admin(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $response=$this->get('editar_perfil_admin');
        $response->assertStatus(200)
            ->assertSee('Editar perfil');
    }
    /** * @test */
    function edit_perfil_student(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $this->put('editar_student',[
            'name'=>'Sergio',
            'lastname'=>'Cartuche',
            'password'=>'sergiocartuche'
        ])->assertRedirect('vista_general_student');
    }
    /** * @test */
    function edit_perfil_docente(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $this->put('editar_docente',[
            'name'=>'Luis',
            'lastname'=>'Chamba',
            'password'=>'luischamba'
        ])->assertRedirect('vista_general_docente');
    }
    /** * @test */
    function edit_perfil_admin(){
        $user=factory(User::class)->create();
        //$this->withoutExceptionHandling();
        $this->actingAs($user);
        
        $this->put('editar_admin',[
            'name'=>'Admin',
            'lastname'=>'SgtCis',
            'password'=>'adminsgtcis'
        ])->assertRedirect('vista_general_admin');
    }
}
