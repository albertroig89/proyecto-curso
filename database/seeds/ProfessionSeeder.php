<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB:insert('INSERT INTO professions (title) VALUES (:title)'. [
//            'title' => 'Desarrollador back-end',
//        ]);                                        //Es el mateix escrit en sql
//      
//      
//        DB::table('professions')->insert([
//           'title' => 'Desarrollador back-end',
//        ]);                                       //Es el mateix escrit en lo constructor de consultes
        
        App\Profession::create([
            'title' => 'Desarrollador back-end', 
        ]);                                         //Es el mateix escrit en models de laravel
        
        Profession::create([                        //Si posem use App\Models\Profession; al principi del php no cal que ho posem cada cop com a l'anterior cas
            'title' => 'Desarrollador front-end',
        ]);
                
        Profession::create([
            'title' => 'Desarrollador web',
        ]);
        
        Profession::create([
            'title' => 'Tecnico informatico',
        ]);
        
        DB::table('professions')->where('title', 'Tecnico informatico')->delete(); //EXERCICI 13 FET EN CONSTRUCTOR DE CONSULTES DE LARAVEL
        
        
        //DB::delete('DELETE FROM professions WHERE (title) = (:title)', ['title' => 'Tecnico informatico']);
        //EXERCICI 13 FET EN SQL
        
        factory(Profession::class, 16)->create();
    }
}
