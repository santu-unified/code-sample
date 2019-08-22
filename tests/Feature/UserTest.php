<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserTypes;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    //use \Illuminate\Foundation\Testing\DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        try{
            //$userObj = factory(UserTypes::class)->create();
            $userObj = factory(User::class)->make();
            $user = [
                'name' => $userObj->name, 
                "email" => $userObj->email,
                "password" => $userObj->password, 
                "password_confirmation" => $userObj->password, 
                "_token" => csrf_token()
            ];

            $response = $this->post('/register',$user);
            $response->assertStatus(302)
            ->assertRedirect('/user/profile');
        }
        catch(\Exception $e){
            die($e->getMessage());
        }
        


    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserLogin()
    {
        // for login test we have to persist data into DB
        $user = factory(User::class)->create([
            'user_type_id' => 1,
            'password' => bcrypt('i-love-laravel'),
        ]);
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'i-love-laravel',
            '_token' => csrf_token()
        ]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/user/profile');
        // $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        // $this->assertFalse(session()->hasOldInput('password'));
        // $this->assertGuest();


    }

}
