<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;


class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/skills.json');

        if ($json) {
            $data = json_decode($json);
            foreach ($data as $obj) {
                Skill::firstOrCreate([
                    'name' => $obj->name,
                    'description' => $obj->description
                ]);
            }
        }
    }
}
