<?php

namespace Database\Seeders;


use App\Models\Operation\Claim\HealthStateChecklist;
use Database\Seeders\countriesTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessTableSeeder.
 */
class Version100TableSeeder extends Seeder
{
    // use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::beginTransaction();

        $this->call(countriesTableSeeder::class);

        DB::commit();
    }
}
