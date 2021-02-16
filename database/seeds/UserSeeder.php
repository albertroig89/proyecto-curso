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
            'profession_id' => $professionId,
            'is_admin' => true
        ]);
        
        /*DB::insert('INSERT INTO users (name, email, password, profession_id) VALUES ("Laia Barco", "laiayniska@gmail.com", "12345678", "2")');*/
        //EXERCICI TEMA 13 FET EN SQL
        
        DB::table('users')->insert([
            'name' => 'Laia Barco',
            'email' => 'laiayniska@gmail.com',
            'password' => bcrypt('laravel2'),
            'profession_id' => '2'
        ]); //EXERCICI TEMA 13 FET EN CONSTRUCTOR DE CONSULTES DE LARAVEL
        
         User::create([
            'name' => 'Lidia Albiol',
            'email' => 'mtlidia55@gmail.com',
            'password' => bcrypt('laravel3'),
            'profession_id' => null
        ]);
         
          User::create([
            'name' => 'Andreu Roig',
            'email' => 'andreubou@gmail.com',
            'password' => bcrypt('laravel4'),
            'profession_id' => $professionId
        ]);
        
    }
}
