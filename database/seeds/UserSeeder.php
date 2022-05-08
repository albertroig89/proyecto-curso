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
        
//        User::create([
//            'name' => 'Albert Roig',
//            'email' => 'albertroiglg@gmail.com',
//            'password' => bcrypt('laravel'),
//            'profession_id' => $professionId,
//            'is_admin' => true
//        ]);
//
//        /*DB::insert('INSERT INTO users (name, email, password, profession_id) VALUES ("Laia Barco", "laiayniska@gmail.com", "12345678", "2")');*/
//        //EXERCICI TEMA 13 FET EN SQL
//
//        DB::table('users')->insert([
//            'name' => 'Joan Roig',
//            'email' => 'joanroig@gmail.com',
//            'password' => bcrypt('laravel2'),
//            'profession_id' => '2'
//        ]); //EXERCICI TEMA 13 FET EN CONSTRUCTOR DE CONSULTES DE LARAVEL
//
//         User::create([
//            'name' => 'Lidia Albiol',
//            'email' => 'mtlidia55@gmail.com',
//            'password' => bcrypt('laravel3'),
//            'profession_id' => null
//        ]);
//
//          User::create([
//            'name' => 'Andreu Roig',
//            'email' => 'andreubou@gmail.com',
//            'password' => bcrypt('laravel4'),
//            'profession_id' => $professionId
//        ]);
        
//        factory(User::class)->create([  //Crea usuari en nom aleatori i les dades que yo li paso
//            'email' => 'joanr@gmail.com',
//            'password' => bcrypt('pass1234'),
//            'profession_id' => $professionId,
//        ]);
        
        $user = factory(User::class)->create([  //Crea usuari en dades aleatories pero en la professio en id 3
            'name' => 'Albert Roig',
            'email' => 'albertroiglg@gmail.com',
            'password' => bcrypt('laravel'),
            'role' => 'admin'
        ]);

        $user->profile()->create([
            'bio' => 'Programador, tontet que aguanta als jefes, cansat estic',
            'profession_id' => $professionId,
        ]);
        
//        factory(User::class)->create(); //Crea un usuari en dades aleatories
        
        factory(User::class, 29)->create()->each(function ($user) {
            $user->profile()->create(
                factory(\App\UserProfile::class)->raw()
            );
        }); //Crea 29 usuaris en dades aleatories
        
    }
}
