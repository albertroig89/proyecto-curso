<?php

use App\Models\Profession;
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
        
        \App\Models\Profession::create([
            'title' => 'Desarrollador back-end', 
        ]);                                         //Es el mateix escrit en models de laravel
        
        Profession::create([                        //Si posem use App\Models\Profession; al principi del php no cal que ho posem cada cop com a l'anterior cas
            'title' => 'Desarrollador front-end',
        ]);
                
        Profession::create([
            'title' => 'Desarrollador web',
        ]);
    }
}
