<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Marcelino',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://educadoronline.club',
        ]);

        $user->perfil()->create();

        $user2 = User::create([
            'name' => 'Juan',
            'email' => 'correo@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://google.com',
        ]);

        $user2->perfil()->create();
    }
}
