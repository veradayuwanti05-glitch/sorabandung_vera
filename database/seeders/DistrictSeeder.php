<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = [
            'Andir', 
            'Antapani', 
            'Arcamanik', 
            'Astanaanyar', 
            'Babakan Ciparay',
            'Bandung Kidul', 
            'Bandung Kulon', 
            'Bandung Wetan', 
            'Batununggal',
            'Bojongloa Kaler', 
            'Bojongloa Kidul', 
            'Buahbatu', 
            'Cibeunying Kaler',
            'Cibeunying Kidul', 
            'Cibiru', 
            'Cicendo', 
            'Cidadap', 
            'Cinambo',
            'Coblong', 
            'Gedebage', 
            'Kiaracondong', 
            'Lengkong', 
            'Mandalajati',
            'Panyileukan', 
            'Rancasari', 
            'Regol', 
            'Sukajadi', 
            'Sukasari',
            'Sumur Bandung', 
            'Ujungberung', 
            'Soreang'
        ];

        foreach ($kecamatan as $nama) {
            DB::table('districts')->insert([
                'name' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}