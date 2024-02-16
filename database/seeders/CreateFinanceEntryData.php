<?php

namespace Database\Seeders;

use App\Models\FinanceEntry;
use Illuminate\Database\Seeder;

class CreateFinanceEntryData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinanceEntry::factory()->count(300)->create();
    }
}
