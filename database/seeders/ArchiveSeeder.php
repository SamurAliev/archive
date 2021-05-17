<?php

namespace Database\Seeders;

use App\Models\Archive;
use App\Models\Cell;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Archive::factory()->count(12)
            ->has(Cell::factory()->count(6)
            ->has( Folder::factory()->count(6)
            ->has( File::factory()->count(10) )))
            ->create();
    }
}
