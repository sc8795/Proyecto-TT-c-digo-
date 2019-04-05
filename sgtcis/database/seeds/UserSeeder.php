<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name'=>'Administrador',
            'lastname'=>'SGTCIS',
            'email'=>'adminsgtcis@unl.edu.ec',
            'password'=>bcrypt('sgtcisadmin'),
            'is_admin'=>true,
            'is_docente'=>false,
            'is_estudiante'=>false,
            'paralelo'=>'NA',
            'ciclo'=>'NA',
        ]);
        factory(User::class)->create([
            'name'=>'Sergio David',
            'lastname'=>'Cartuche Morocho',
            'email'=>'sdcartuchem@unl.edu.ec',
            'password'=>bcrypt('sergiocartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Décimo',
        ]);

        factory(User::class)->create([
            'name'=>'Johnny Fabián',
            'lastname'=>'González Guamán',
            'email'=>'johnnygonzalez@unl.edu.ec',
            'password'=>bcrypt('johnnygonzalez'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Décimo',
        ]);
        factory(User::class)->create([
            'name'=>'Andrés Darío',
            'lastname'=>'Morocho Cumbicus',
            'email'=>'andresmorocho@unl.edu.ec',
            'password'=>bcrypt('andresmorocho'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Noveno',
        ]);
        factory(User::class)->create([
            'name'=>'Dalton Santiago',
            'lastname'=>'Morocho Cumbicus',
            'email'=>'daltonmorocho@unl.edu.ec',
            'password'=>bcrypt('daltonmorocho'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Noveno',
        ]);
        factory(User::class)->create([
            'name'=>'Pedro David',
            'lastname'=>'Arévalo Marín',
            'email'=>'pedroarevalo@unl.edu.ec',
            'password'=>bcrypt('pedroarevalo'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Octavo',
        ]);
        factory(User::class)->create([
            'name'=>'Nayo Francisco',
            'lastname'=>'Salinas Minga',
            'email'=>'nayosalinas@unl.edu.ec',
            'password'=>bcrypt('nayosalinas'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Octavo',
        ]);
        factory(User::class)->create([
            'name'=>'Alex Rubén',
            'lastname'=>'Condoy Carrión',
            'email'=>'alexcondoy@unl.edu.ec',
            'password'=>bcrypt('alexcondoy'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Séptimo',
        ]);
        factory(User::class)->create([
            'name'=>'Adriana Carolina',
            'lastname'=>'Gómez Jara',
            'email'=>'adrianagomez@unl.edu.ec',
            'password'=>bcrypt('adrianagomez'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Séptimo',
        ]);
        factory(User::class)->create([
            'name'=>'Monica Nicole',
            'lastname'=>'Coronel Cárdenas',
            'email'=>'monicacoronel@unl.edu.ec',
            'password'=>bcrypt('monicacoronel'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Sexto',
        ]);
        factory(User::class)->create([
            'name'=>'Wilmer Fernando',
            'lastname'=>'Morocho Cumbicus',
            'email'=>'wilmermorocho@unl.edu.ec',
            'password'=>bcrypt('wilmermorocho'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Sexto',
        ]);
        factory(User::class)->create([
            'name'=>'Mauricio Fernando',
            'lastname'=>'Cartuche Morocho',
            'email'=>'mauriciocartuche@unl.edu.ec',
            'password'=>bcrypt('mauriciocartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Quinto',
        ]);
        factory(User::class)->create([
            'name'=>'Wilma Andrea',
            'lastname'=>'Cartuche Morocho',
            'email'=>'wilmacartuche@unl.edu.ec',
            'password'=>bcrypt('wilmacartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Quinto',
        ]);
        factory(User::class)->create([
            'name'=>'Ángel Xavier',
            'lastname'=>'Cartuche Morocho',
            'email'=>'angelcartuche@unl.edu.ec',
            'password'=>bcrypt('angelcartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Cuarto',
        ]);
        factory(User::class)->create([
            'name'=>'Flor Magaly',
            'lastname'=>'Cartuche Morocho',
            'email'=>'florcartuche@unl.edu.ec',
            'password'=>bcrypt('florcartuche'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Cuarto',
        ]);
        factory(User::class)->create([
            'name'=>'Lida Cecibel',
            'lastname'=>'Carrera Arias',
            'email'=>'lidacarrera@unl.edu.ec',
            'password'=>bcrypt('lidacarrera'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Tercero',
        ]);
        factory(User::class)->create([
            'name'=>'Verónica del Cisne',
            'lastname'=>'Jiménez Carreño',
            'email'=>'veronicajimenez@unl.edu.ec',
            'password'=>bcrypt('veronicajimenez'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Tercero',
        ]);
        factory(User::class)->create([
            'name'=>'Mishel Alexandra',
            'lastname'=>'Morocho Ochoa',
            'email'=>'mishelmorocho@unl.edu.ec',
            'password'=>bcrypt('mishelmorocho'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Segundo',
        ]);
        factory(User::class)->create([
            'name'=>'Tatiana Elizabeth',
            'lastname'=>'Tene Pucha',
            'email'=>'tatianatene@unl.edu.ec',
            'password'=>bcrypt('tatianatene'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Segundo',
        ]);
        factory(User::class)->create([
            'name'=>'Carla de Lourdes',
            'lastname'=>'Lima Morocho',
            'email'=>'carlalima@unl.edu.ec',
            'password'=>bcrypt('carlalima'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'A',
            'ciclo'=>'Primero',
        ]);
        factory(User::class)->create([
            'name'=>'Melissa Gabriela',
            'lastname'=>'Quille Cartuche',
            'email'=>'melissaquille@unl.edu.ec',
            'password'=>bcrypt('melissaquille'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true,
            'paralelo'=>'B',
            'ciclo'=>'Primero',
        ]);
    }
}
