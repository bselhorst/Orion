<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AuxCept;

class CeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AuxCept::create(['nome' => 'Ceflora']);
        AuxCept::create(['nome' => 'Campos Pereira']);
        AuxCept::create(['nome' => 'Escola da Floresta Roberval Cardoso']);
        AuxCept::create(['nome' => 'Escola de Gastronomia e Hospitalidade']);
        AuxCept::create(['nome' => 'Escola de Saúde Maria Moreira da Rocha']);
        AuxCept::create(['nome' => 'João de Deus']);
        AuxCept::create(['nome' => 'Núcleo de Tarauacá']);
        AuxCept::create(['nome' => 'Usina de Artes João Donato']);
    }
}
