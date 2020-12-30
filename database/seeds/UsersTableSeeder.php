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
        $alvaro = User::create([
            'name' => 'Alvaro Perez',
            'email' => 'comercialsupra4@gmail.com',
            'password' => bcrypt('suprajapan'),
            'url' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20)
        ]);

        $luis = User::create([
            'name' => 'Luis Cuello',
            'email' => 'lcuelloalfa@gmail.com',
            'password' => bcrypt('luisc')
        ]);

        $mechanic = User::create([
            'name' => 'Usuario Mecanico',
            'email' => 'mecanico@correo.com',
            'password' => bcrypt('mechanic')
        ]);

        $client = User::create([
            'name' => 'Usuario Cliente',
            'email' => 'cliente@correo.com',
            'password' => bcrypt('client')
        ]);

        $alvaro->assignRole('admin');
        $luis->assignRole('admin');

        $mechanic->assignRole('mechanic');
        $client->assignRole('client');
    }
}
