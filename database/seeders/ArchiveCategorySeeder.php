<?php

namespace Database\Seeders;

use App\Models\ArchiveCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArchiveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'archive_category'=>'Undangan',
            ],
            [
                'archive_category'=>'Pengumuman',
            ],
            [
                'archive_category'=>'Nota Dinas',
            ],
            [
                'archive_category'=>'Pemberitahuan',
            ],
        ];

        ArchiveCategory::insert($category);
    }
}
