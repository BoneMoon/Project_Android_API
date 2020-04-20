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
            'titulo' => Str::random(10),
            'descricao' => Str::random(10),
            'tipodescricao' => Str::random(10),
            'foto' => Str::random(10),
            'localizacao' => Str::random(10),
            'user_id' => 1
        ]);
    }
}
