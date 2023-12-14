<?php

namespace Database\Seeders;

use App\Models\mobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobil = [
            [
                'nama' => 'Mitsubishi Canter',
                'plat' => 'BG1234AB'
            ],
            [
                'nama' => 'Mitsubishi Canter',
                'plat' => 'BG7388BC'
            ],
            [
                'nama' => 'Mitsubishi Canter',
                'plat' => 'BG9182BD'
            ],
            [
                'nama' => 'Mitsubishi Canter',
                'plat' => 'BG9742AC'
            ],
        ];

        foreach($mobil as $key => $val) {
            mobil::create($val);
        }
    }
}
