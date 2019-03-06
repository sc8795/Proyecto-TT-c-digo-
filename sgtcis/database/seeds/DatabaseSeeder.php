<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTable([
    		'users',
    		'materias'
        ]);
        
        $this->call(UserSeeder::class);
        //$this->call(MateriaSeeder::class);
        
    }

    protected function truncateTable(array $tables){
    	/*sentencia para desactivar la revision de llaves foraneas en la BD*/
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	foreach ($tables as $table) {
    		/*este metodo permite vaciar la tabla*/
    		DB::table($table)->truncate();
    	}
    	/*para activar la revision de llaves foranes en la BD*/
    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
