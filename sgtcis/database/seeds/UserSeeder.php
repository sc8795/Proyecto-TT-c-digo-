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
            'name'=>'sgtcisadmin',
            'email'=>'adminsgtcis@unl.edu.ec',
            'password'=>bcrypt('sgtcisadmin'),
            'is_admin'=>true,
            'is_docente'=>false,
            'is_estudiante'=>false
        ]);
        factory(User::class)->create([
            'name'=>'sgtcisadmin3',
            'email'=>'adminsgtcis3@unl.edu.ec',
            'password'=>bcrypt('sgtcisadmin3'),
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);

        factory(User::class)->create([
            'name'=>'sgtcisadmin1',
            'email'=>'adminsgtcis1@unl.edu.ec',
            'password'=>bcrypt('sgtcisadmin1'),
            'is_admin'=>true,
            'is_docente'=>false,
            'is_estudiante'=>false
        ]);
    }
}
