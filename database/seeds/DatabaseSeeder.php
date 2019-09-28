<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        if (env('DB_CONNECTION') == "mysql")
        {
            self::cleanDatabaseByMysql();
        }
        elseif(env('DB_CONNECTION') == "pgsql")
        {
            self::cleanDatabaseByPostgres();
        }

        $this->call(OptionsTableSeeder::class);
        $this->call(RolsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        factory(\App\Models\Category::class, 25)->create();
        factory(\App\Models\ClientType::class, 2)->create();
        factory(\App\Models\DocumentType::class, 2)->create();
        $this->call(VoucherTypeTableSeeder::class);
        factory(\App\Models\Client::class, 25)->create();
        factory(\App\Models\Product::class, 25)->create();
        $this->call(CompaniesTableSeeder::class);
    }

    public function cleanDatabaseByPostgres()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.tables 
                                WHERE table_catalog = 'ventas_ci_v2' AND 
                                      table_type = 'BASE TABLE' AND 
                                      table_schema = 'public' 
                                      ORDER BY table_name");

        

        foreach ($tables as $tableName) {
            DB::statement("ALTER TABLE $tableName->table_name DISABLE TRIGGER ALL");
            DB::statement("TRUNCATE TABLE $tableName->table_name RESTART IDENTITY CASCADE");
            DB::statement("ALTER TABLE $tableName->table_name ENABLE TRIGGER ALL");
        }
    }

    public function cleanDatabaseByMysql()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        \App\Models\Option::truncate();
        \App\Models\Rol::truncate();
        \App\Models\User::truncate();
        \App\Models\Configuration::truncate();
        \App\Models\Category::truncate();
        \App\Models\ClientType::truncate();
        \App\Models\DocumentType::truncate();
        \App\Models\VoucherType::truncate();
        \App\Models\Client::truncate();
        \App\Models\Product::truncate();
        \App\Models\Company::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
