<?php

use App\Models\User;
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
        User::create([
            "first_name" => "Jorge",
            "last_name" => "Tigrero",
            "username" => "admin",
            "phone" => '0999999999',
            "name" => "Administrador",
            "email" => "admin@mail.com",
            'image' => "avatar.png",
            "password" => bcrypt("admin")
        ]);

        //asigna todas las opciones al usuario 1
        User::findOrFail(1)->options()->sync([
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21
        ]);

        //asigna todos los roles al usuario 1
        User::findOrFail(1)->rols()->sync([
            1,2,3
        ]);
    }
}
