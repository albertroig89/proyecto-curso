<?php

namespace App\Providers;

use App\Profession;
use App\Skill;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('shared._card', 'card');

        View::composer(['users.create', 'users.edit', 'shared._professionerror'], function ($view) {
            $professions = Profession::orderBy('title', 'ASC')->get();
            $skills = Skill::orderBy('name', 'ASC')->get();
            $roles = trans('users.roles');

            $view->with(compact('professions', 'skills', 'roles'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
