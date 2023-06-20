<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('bio', 1000);
            $table->string('twitter')->nullable();

            $table->unsignedInteger('profession_id')->nullable();
            $table->foreign('profession_id')
                ->references('id')
                ->on('professions');
//                ->onDelete('CASCADE') Borra el camp i tots els perfils als que esta associat
//                ->onDelete('SET NULL') Borra el camp i posa en null el camp que hem eliminat a tots els perfils que el continguen


            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE'); //Al borrar l'usuari borrara el perfil associat a l'usuari pero sense borrar les professions que tenim introduides

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
