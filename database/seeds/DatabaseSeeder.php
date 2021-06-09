<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
           'users',
           'skills',
           'professions',
        ]);

//        $this->call(ProfessionSeeder::class); CRIDAR AL SEEDER 1 EN 1
        $this->call([
            ProfessionSeeder::class,
            SkillSeeder::class,
            UserSeeder::class,
        ]);
    }
    
    protected function truncateTables(array $tables) {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); //Aixo elimina la comprobacio de claus foranees per a borrar el contingut de la taula
        foreach ($tables as $table){
            DB::table($table)->truncate(); //Aixo elimina tots els registres de la taula per a poder tornar-los a crear
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); //Torna a activar comprobacio de claus foranees
    }
}
