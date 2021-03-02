<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['Semanal'],
            ['Quincenal'],
            ['Mensual']
        ];
        
        $tipos = array_map(function($tipo) {
            return [
                'nombre' => $tipo[0]
            ];
        }, $tipos);
        
        DB::table('tipos')->insert($tipos);
    }
}
