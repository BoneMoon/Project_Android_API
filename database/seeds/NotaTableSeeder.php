<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notas')->insert([
            'titulo' => 'titulo1',
            'descricao' => 'descricao1',
            'tipodescricao' => 'tipo1',
            'foto' => Str::random(10),
            'latitude' => 1.786,
            'longitude' => 3.786,
            'user_id' => 1
        ]);
    }
}
