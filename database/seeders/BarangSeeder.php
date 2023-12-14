<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua Galon',
            'kode_barang' => '82002',
            'harga_barang' => '21200',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua 240ML 1 dus', // 1 dus isi 24 botol
            'kode_barang' => '82007',
            'harga_barang' => '29000',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua 330ML 1 dus', // 1 dus isi 24 botol
            'kode_barang' => '82006',
            'harga_barang' => '39000',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua 600ML 1 dus', // 1 dus isi 24 botol
            'kode_barang' => '82008',
            'harga_barang' => '46300',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua 1500ML 1 dus', // 1 dus isi 12 botol
            'kode_barang' => '82010',
            'harga_barang' => '52600',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Aqua 750ML Click & GO', // 1 dus isi 18 botol
            'kode_barang' => '82014',
            'harga_barang' => '76700',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Mizone Activ', // 1 dus isi 12 botol
            'kode_barang' => '82409',
            'harga_barang' => '41600',
            'stock' => '100',
        ]);
        \App\Models\Barang::factory()->create([
            'nama_barang' => 'Mizone Mood Up', // 1 dus isi 12 botol
            'kode_barang' => '82411',
            'harga_barang' => '41600',
            'stock' => '100',
        ]);
    }
}
