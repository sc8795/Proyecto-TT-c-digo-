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
            'is_estudiante'=>false
        ]);
        factory(User::class)->create([
            'name'=>'Luis Antonio',
            'lastname'=>'Chamba Eras',
            'email'=>'luisantonio@unl.edu.ec',
            'password'=>bcrypt('luisantonio'),
            'is_admin'=>false,
            'is_docente'=>true,
            'is_estudiante'=>false
        ]);

        factory(User::class)->create([
            'name'=>'Serdio David',
            'lastname'=>'Cartuche Morocho',
            'email'=>'sdcartuchem@unl.edu.ec',
            'password'=>bcrypt('sergiodavid'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true
        ]);
        factory(User::class)->create([
            'name'=>'Génesis Yoreli',
            'lastname'=>'Jumbo Chalán',
            'email'=>'gyjumboc@unl.edu.ec',
            'password'=>bcrypt('genesisjumbo'),
            'is_admin'=>false,
            'is_docente'=>false,
            'is_estudiante'=>true
        ]);
    }
}
