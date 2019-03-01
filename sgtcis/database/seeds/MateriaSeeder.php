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
            'ciclo'=>'primero'
        ]);
        Materia::create([
            'name'=>'COMUNICACIÓN PROFESIONAL',
            'ciclo'=>'primero'
        ]);
        Materia::create([
            'name'=>'ÁLGEBRA LINEAL',
            'ciclo'=>'primero'
        ]);
        Materia::create([
            'name'=>'TEORÍA DE LA PROGRAMACIÓN',
            'ciclo'=>'primero'
        ]);
        Materia::create([
            'name'=>'ELECTRICIDAD',
            'ciclo'=>'primero'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEGUNDO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'MATEMÁTICAS DISCRETAS',
            'ciclo'=>'segundo'
        ]);
        Materia::create([
            'name'=>'CÁLCULO DIFERENCIAL',
            'ciclo'=>'segundo'
        ]);
        Materia::create([
            'name'=>'TEORÍA DE LA DISTRIBUCIÓN Y PROBABILIDAD',
            'ciclo'=>'segundo'
        ]);
        Materia::create([
            'name'=>'PROGRAMACIÓN ORIENTADA A OBJETOS',
            'ciclo'=>'segundo'
        ]);
        Materia::create([
            'name'=>'DISEÑO DE CIRCUITOS',
            'ciclo'=>'segundo'
        ]);
        Materia::create([
            'name'=>'TECNOLOGÍA Y CAMBIO SOCIAL',
            'ciclo'=>'segundo'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL TERCER CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'ESTRUCTURA DE DATOS Y ALGORITMOS FUNDAMENTALES',
            'ciclo'=>'tercero'
        ]);
        Materia::create([
            'name'=>'CÁLCULO INTEGRAL',
            'ciclo'=>'tercero'
        ]);
        Materia::create([
            'name'=>'ESTADÍSTICA ANALÍTICA',
            'ciclo'=>'tercero'
        ]);
        Materia::create([
            'name'=>'BANCOS DE DATOS',
            'ciclo'=>'tercero'
        ]);
        Materia::create([
            'name'=>'ARQUITECTURA DE ORDENADORES',
            'ciclo'=>'tercero'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: PROYECTO DE VINCULACIÓN: "CENTRO DE ASESORÍA TECNOLÓGICA"',
            'ciclo'=>'tercero'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL CUARTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'ESTRUCTURAS DE DATOS AVANZADAS',
            'ciclo'=>'cuarto'
        ]);
        Materia::create([
            'name'=>'ECUACIONES DIFERENCIALES',
            'ciclo'=>'cuarto'
        ]);
        Materia::create([
            'name'=>'INGENIERÍA DE LA CONTAMINACIÓN',
            'ciclo'=>'cuarto'
        ]);
        Materia::create([
            'name'=>'PROCESAMIENTO DE TRANSACCIONES',
            'ciclo'=>'cuarto'
        ]);
        Materia::create([
            'name'=>'PROCESOS DE SOFTWARE',
            'ciclo'=>'cuarto'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL QUINTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'COMPLEJIDAD COMPUTACIONAL',
            'ciclo'=>'quinto'
        ]);
        Materia::create([
            'name'=>'ANÁLISIS NUMÉRICO',
            'ciclo'=>'quinto'
        ]);
        Materia::create([
            'name'=>'ECONOMÍA DE LA COMPUTACIÓN',
            'ciclo'=>'quinto'
        ]);
        Materia::create([
            'name'=>'PLATAFORMAS WEB',
            'ciclo'=>'quinto'
        ]);
        Materia::create([
            'name'=>'ADMINISTRACIÓN DE PROYECTOS DE SOFTWARE',
            'ciclo'=>'quinto'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEXTO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'TEORÍA DE AUTÓMATAS Y COMPUTABILIDAD AVANZADA',
            'ciclo'=>'sexto'
        ]);
        Materia::create([
            'name'=>'SISTEMAS OPERATIVOS',
            'ciclo'=>'sexto'
        ]);
        Materia::create([
            'name'=>'INTRODUCCIÓN A LAS REDES Y COMUNICACIONES',
            'ciclo'=>'sexto'
        ]);
        Materia::create([
            'name'=>'PLATAFORMAS MÓVILES',
            'ciclo'=>'sexto'
        ]);
        Materia::create([
            'name'=>'CÁTEGRA INTEGRADORA: APLICACIONES WEB Y MÓVILES',
            'ciclo'=>'sexto'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL SEPTIMO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'COMPILADORES',
            'ciclo'=>'septimo'
        ]);
        Materia::create([
            'name'=>'SISTEMAS DISTRIBUIDOS',
            'ciclo'=>'septimo'
        ]);
        Materia::create([
            'name'=>'GESTIÓN DE REDES Y COMUNICACIONES',
            'ciclo'=>'septimo'
        ]);
        Materia::create([
            'name'=>'INTERACCIÓN PERSONA-COMPUTADOR',
            'ciclo'=>'septimo'
        ]);
        Materia::create([
            'name'=>'METODOLOGÍA DE LA INVESTIGACIÓN EN LA COMPUTACIÓN',
            'ciclo'=>'septimo'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: INFRAESTRUCTURA DE REDES Y COMUNICACIONES',
            'ciclo'=>'septimo'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL OCTAVO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'INVESTIGACIÓN DE OPERACIONES',
            'ciclo'=>'octavo'
        ]);
        Materia::create([
            'name'=>'PERCEPCIÓN Y VISIÓN COMPUTACIONAL',
            'ciclo'=>'octavo'
        ]);
        Materia::create([
            'name'=>'ÉTICA PROFESIONAL',
            'ciclo'=>'octavo'
        ]);
        Materia::create([
            'name'=>'ALGORITMOS, ANÁLISIS Y PROGRAMACIÓN PARALELA',
            'ciclo'=>'octavo'
        ]);
        Materia::create([
            'name'=>'PROYECTOS TECNOLÓGICOS I',
            'ciclo'=>'octavo'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INTEGRADORA: PROYECTOS TECNOLÓGICOS Y/O DE EMPRENDIMIENTO ORIENTADOS A LOS SECTORES URBANO MARGINALES, RURALES Y COMUNIDADES VULNERABLES',
            'ciclo'=>'octavo'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL NOVENO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'SEGURIDAD DE LA INFORMACIÓN',
            'ciclo'=>'noveno'
        ]);
        Materia::create([
            'name'=>'APRENDIZAJE AUTOMÁTICO',
            'ciclo'=>'noveno'
        ]);
        Materia::create([
            'name'=>'COMPUTACIÓN EN LA NUBE',
            'ciclo'=>'noveno'
        ]);
        Materia::create([
            'name'=>'PROYECTOS TECNOLÓGICOS II',
            'ciclo'=>'noveno'
        ]);
        Materia::create([
            'name'=>'CÁTEDRA INNOVADORA: SEGURIDAD Y/O APLICACIONES INTELIGENTES',
            'ciclo'=>'noveno'
        ]);
/* 
|--------------------------------------------------------------------------
| MATERIAS DEL DECIMO CICLO
|--------------------------------------------------------------------------
*/
        Materia::create([
            'name'=>'SIMULACIÓN',
            'ciclo'=>'decimo'
        ]);
        Materia::create([
            'name'=>'MINERÍA DE DATOS',
            'ciclo'=>'decimo'
        ]);
        Materia::create([
            'name'=>'REDACCIÓN CIENTÍFICA',
            'ciclo'=>'decimo'
        ]);
        Materia::create([
            'name'=>'TRABAJO DE TITULACIÓN',
            'ciclo'=>'decimo'
        ]);
    }
}
