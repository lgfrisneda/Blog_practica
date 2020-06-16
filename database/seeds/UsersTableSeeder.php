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
        
        $nombre = 'Usuario Fijo';
        factory(User::class)->create([    
            'name' => $nombre,
            'slug' => str_slug($nombre),
            'email' => 'correo@email.com',
            'password' => bcrypt('123')
        ]);
    }
}
