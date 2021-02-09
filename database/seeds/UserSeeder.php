<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', [Desarrollador back-end]);
        
        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id'); 
        //Es el mateix que la linea anterior pero en eloquent enlloc de sql
        
        User::create([
            'name' => 'Albert Roig',
            'email' => 'albertroiglg@gmail.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId
        ]);
    }
}
