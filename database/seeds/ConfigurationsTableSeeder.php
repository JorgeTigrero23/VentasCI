<?php

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();
        \DB::table('configurations')->insert([
            0 => 
            [
                'id' => 1,
                'key' => 'app.name',
                'value' => 'SISFACTV1',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL,
            ]
        ]);
    }
}
