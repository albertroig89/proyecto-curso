<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /**
     * @test
     */
    
    function it_welcomes_users_with_nickname()
    {
        $this->get('/saludo/albert/sdarcknes')
                ->assertStatus(200)
                ->assertSee('Bienvenido Albert, tu apodo es sdarcknes');
    }
    
    /**
     * @test
     */
    
    function it_welcomes_users_without_nickname()
    {
        $this->get('/saludo/albert')
                ->assertStatus(200)
                ->assertSee('Bienvenido Albert');
    }
}
