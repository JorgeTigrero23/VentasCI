<?php

use Illuminate\Database\Seeder;

use App\Models\VoucherType;

class VoucherTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VoucherType::create(["name" => "Factura", "quantity" => 0, "igv" => 12, "serie" => "001"]);
        VoucherType::create(["name" => "Boleta", "quantity" => 0, "igv" => 0, "serie" => "001"]);
    }
}
