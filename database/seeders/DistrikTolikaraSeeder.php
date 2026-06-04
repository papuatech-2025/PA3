<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrikTolikaraSeeder extends Seeder
{
    public function run(): void
    {
        $distrik = [
            ['kode' => 'KRB', 'name' => 'Karubaga', 'description' => 'Ibu kota Kabupaten Tolikara'],
            ['kode' => 'KGM', 'name' => 'Kanggime', 'description' => 'Distrik Kanggime'],
            ['kode' => 'BKN', 'name' => 'Bokoneri', 'description' => 'Distrik Bokoneri'],
            ['kode' => 'KMB', 'name' => 'Kembu', 'description' => 'Distrik Kembu'],
            ['kode' => 'GYG', 'name' => 'Goyage', 'description' => 'Distrik Goyage'],
            ['kode' => 'WNM', 'name' => 'Wunim', 'description' => 'Distrik Wunim'],
            ['kode' => 'WNK', 'name' => 'Woniki', 'description' => 'Distrik Woniki'],
            ['kode' => 'TMR', 'name' => 'Timori', 'description' => 'Distrik Timori'],
            ['kode' => 'NLW', 'name' => 'Nelawi', 'description' => 'Distrik Nelawi'],
            ['kode' => 'KRI', 'name' => 'Kuari', 'description' => 'Distrik Kuari'],
            ['kode' => 'BKD', 'name' => 'Bokondini', 'description' => 'Distrik Bokondini'],
            ['kode' => 'KBU', 'name' => 'Kubu', 'description' => 'Distrik Kubu'],
        ];

        foreach ($distrik as $d) {
            DB::table('distrik')->updateOrInsert(
                ['kode' => $d['kode']],
                [
                    'name' => $d['name'],
                    'description' => $d['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        $this->command->info('✅ Data distrik Tolikara berhasil ditambahkan!');
    }
}