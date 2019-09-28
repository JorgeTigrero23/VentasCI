<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();
        \DB::table('companies')->insert([
            0 => 
            [
                'id' => 1,
                'name' => 'Empresa se facturación',
                'nature' => 'Empresa Privada',
                'phone' => '1234567890',
                'fax' => '1234567',
                'country' => 'Ecuador',
                'city' => 'Santa Elena',
                'address' => 'Av Samborondon y la que cruza',
                'image' => 'logo.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
