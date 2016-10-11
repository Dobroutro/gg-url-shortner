<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationLoginTest extends TestCase
{

    use DatabaseTransactions;

    public function testNewUserRegistration()
    {
        $this->visit('register')
            ->type('Tester 2', 'name')
            ->type('testuser2@test.com', 'email')
            ->type('hello1', 'password')
            ->type('hello1', 'password_confirmation')
            ->press('Register')
            ->see('Items API Home')
            ->seePageIs('/home')
            ->seeInDatabase('users', ['email' => 'testuser2@test.com']);
    }

    public function testUserLogin()
    {
        $this->visit('/login')
            ->submitForm('Login', ['email' => 'tester@test.com', 'password' => 'aaaaaa'])
            ->see('Items API Home')
            ->seePageIs('/home');
    }
}
