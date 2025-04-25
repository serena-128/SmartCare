<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportSmartcareSchemaSeeder extends Seeder
{
    public function run()
    {
        $sql = File::get(database_path('sql/smartcare_schema.sql'));
        DB::unprepared($sql);
    }
}
