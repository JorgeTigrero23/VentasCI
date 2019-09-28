<?php

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create(["description" => "admin"]);
        Rol::create(["description" => "seller"]);
        Rol::create(["description" => "secretary"]);
    }
}
