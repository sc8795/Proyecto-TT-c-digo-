<?php

use Illuminate\Database\Seeder;
use App\Materia;
use App\User;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Obtengo el id del usuario con el nombre Luis Antonio*/
        $user_id=User::where('name','Luis Antonio')->value('id');
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL PRIMER CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'INTRODUCCIÓN A LAS CIENCIAS DE LA COMPUTACIÓN',
            'ciclo'=>'primero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'COMUNICACIÓN PROFESIONAL',
            'ciclo'=>'primero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ÁLGEBRA LINEAL',
            'ciclo'=>'primero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'TEORÍA DE LA PROGRAMACIÓN',
            'ciclo'=>'primero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ELECTRICIDAD',
            'ciclo'=>'primero',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEGUNDO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'MATEMÁTICAS DISCRETAS',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁLCULO DIFERENCIAL',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'TEORÍA DE LA DISTRIBUCIÓN Y PROBABILIDAD',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PROGRAMACIÓN ORIENTADA A OBJETOS',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'DISEÑO DE CIRCUITOS',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'TECNOLOGÍA Y CAMBIO SOCIAL',
            'ciclo'=>'segundo',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL TERCER CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'ESTRUCTURA DE DATOS Y ALGORITMOS FUNDAMENTALES',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁLCULO INTEGRAL',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ESTADÍSTICA ANALÍTICA',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'BANCOS DE DATOS',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ARQUITECTURA DE ORDENADORES',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: PROYECTO DE VINCULACIÓN: "CENTRO DE ASESORÍA TECNOLÓGICA"',
            'ciclo'=>'tercero',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL CUARTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'ESTRUCTURAS DE DATOS AVANZADAS',
            'ciclo'=>'cuarto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ECUACIONES DIFERENCIALES',
            'ciclo'=>'cuarto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'INGENIERÍA DE LA CONTAMINACIÓN',
            'ciclo'=>'cuarto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PROCESAMIENTO DE TRANSACCIONES',
            'ciclo'=>'cuarto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PROCESOS DE SOFTWARE',
            'ciclo'=>'cuarto',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL QUINTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'COMPLEJIDAD COMPUTACIONAL',
            'ciclo'=>'quinto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ANÁLISIS NUMÉRICO',
            'ciclo'=>'quinto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ECONOMÍA DE LA COMPUTACIÓN',
            'ciclo'=>'quinto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PLATAFORMAS WEB',
            'ciclo'=>'quinto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ADMINISTRACIÓN DE PROYECTOS DE SOFTWARE',
            'ciclo'=>'quinto',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEXTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'TEORÍA DE AUTÓMATAS Y COMPUTABILIDAD AVANZADA',
            'ciclo'=>'sexto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'SISTEMAS OPERATIVOS',
            'ciclo'=>'sexto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'INTRODUCCIÓN A LAS REDES Y COMUNICACIONES',
            'ciclo'=>'sexto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PLATAFORMAS MÓVILES',
            'ciclo'=>'sexto',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁTEGRA INTEGRADORA: APLICACIONES WEB Y MÓVILES',
            'ciclo'=>'sexto',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEPTIMO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'COMPILADORES',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'SISTEMAS DISTRIBUIDOS',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'GESTIÓN DE REDES Y COMUNICACIONES',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'INTERACCIÓN PERSONA-COMPUTADOR',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'METODOLOGÍA DE LA INVESTIGACIÓN EN LA COMPUTACIÓN',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: INFRAESTRUCTURA DE REDES Y COMUNICACIONES',
            'ciclo'=>'septimo',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL OCTAVO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'INVESTIGACIÓN DE OPERACIONES',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PERCEPCIÓN Y VISIÓN COMPUTACIONAL',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ÉTICA PROFESIONAL',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'ALGORITMOS, ANÁLISIS Y PROGRAMACIÓN PARALELA',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PROYECTOS TECNOLÓGICOS I',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: PROYECTOS TECNOLÓGICOS Y/O DE EMPRENDIMIENTO ORIENTADOS A LOS SECTORES URBANO MARGINALES, RURALES Y COMUNIDADES VULNERABLES',
            'ciclo'=>'octavo',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL NOVENO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'SEGURIDAD DE LA INFORMACIÓN',
            'ciclo'=>'noveno',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'APRENDIZAJE AUTOMÁTICO',
            'ciclo'=>'noveno',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'COMPUTACIÓN EN LA NUBE',
            'ciclo'=>'noveno',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'PROYECTOS TECNOLÓGICOS II',
            'ciclo'=>'noveno',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INNOVADORA: SEGURIDAD Y/O APLICACIONES INTELIGENTES',
            'ciclo'=>'noveno',
            'paralelo'=>'A'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL DECIMO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'SIMULACIÓN',
            'ciclo'=>'decimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'MINERÍA DE DATOS',
            'ciclo'=>'decimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'REDACCIÓN CIENTÍFICA',
            'ciclo'=>'decimo',
            'paralelo'=>'A'
        ]);
        Materia::create([
            'name'=>'TRABAJO DE TITULACIÓN',
            'ciclo'=>'decimo',
            'paralelo'=>'A'
        ]);
    }
}
