<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(User::class, 29)->create();

        factory(User::class)->create([
            'name' => 'Usuario Fijo',
            'email' => 'correo@email.com',
            'password' => bcrypt('123')
        ]);
    }
}
