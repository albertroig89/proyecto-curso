<?php

namespace App\Console\Commands;

use App\Profession;
use App\User;
use Illuminate\Console\Command;

class TestComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $professions = Profession::all();
//
//        $user = new User();
//
//        $user -> profession_id = 3;
//        $user -> name = 'Albert Roig';
//        $user -> email = 'albertroiglg2@gmail.com';
//        $user -> password = '123456';
//
//
//        $user -> save();

        $user = User::find(14);

        $user -> profession_id = 3;

        $user -> save();
    }
}
