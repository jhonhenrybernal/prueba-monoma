<?php
use Tests\TestCase;
use Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $userData = [
            'name' => 'jhon bernal',
            'username' => 'jhobnbernal',
            'password' => bcrypt('password123'),
            'role' =>  1,
            'is_Active' => true,
            'remember_token' => Str::random(10),
            'last_login' =>  \Carbon\Carbon::now()->format('d-m-Y H:i:s')
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'username' => 'jhobnbernal',
        ]);
    }
}
