<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/careers.json');

        if ($json) {
            $data = json_decode($json);

            foreach ($data as $obj) {
                Career::firstOrCreate([
                    'title' => $obj->name,
                    'description' => $obj->description
                ]);
            }
        }
    }
}
