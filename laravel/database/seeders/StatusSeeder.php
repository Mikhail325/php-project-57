<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::firstOrCreate(['name' => 'новый']);
        Status::firstOrCreate(['name' => 'в работе']);
        Status::firstOrCreate(['name' => 'на тестировании']);
        Status::firstOrCreate(['name' => 'завершен']);
    }
}
