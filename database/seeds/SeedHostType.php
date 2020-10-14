<?php

use Illuminate\Database\Seeder;

class SeedHostType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            ['id' => 1, 'name' => 'Outro', 'tag_prefix' => 'CPDN'],
            ['id' => 2, 'name' => 'Servidor físico', 'tag_prefix' => 'CPDC'],
            ['id' => 3, 'name' => 'Maquina virtual', 'tag_prefix' => 'CPDV'],
            ['id' => 4, 'name' => 'Storage', 'tag_prefix' => 'CPDN'],
            ['id' => 5, 'name' => 'Switch', 'tag_prefix' => 'CPDS'],
            ['id' => 6, 'name' => 'Router', 'tag_prefix' => 'CPDR'],
            ['id' => 7, 'name' => 'Telefone IP', 'tag_prefix' => 'CPDT'],
            ['id' => 8, 'name' => 'Access Point', 'tag_prefix' => 'CPDW'],
            ['id' => 9, 'name' => 'Câmera IP', 'tag_prefix' => 'CPDE'],
            ['id' => 10, 'name' => 'Encoder de câmeras', 'tag_prefix' => 'CPDE'],
            ['id' => 11, 'name' => 'Desktop', 'tag_prefix' => 'CPDD'],
            ['id' => 12, 'name' => 'Laptop', 'tag_prefix' => 'CPDL'],
            ['id' => 13, 'name' => 'Impressora de Rede', 'tag_prefix' => 'CPDI'],
            ['id' => 14, 'name' => 'Nobreak', 'tag_prefix' => 'CPDN'],
            ['id' => 15, 'name' => 'Drive de fita LTO', 'tag_prefix' => 'CPDN'],
            ['id' => 16, 'name' => 'Gateway de Telefonia', 'tag_prefix' => 'CPDN'],
            ['id' => 17, 'name' => 'Controlador de rede sem fio', 'tag_prefix' => 'CPDR'],
        ];

        //DB::table('host_types')->delete();
        DB::table('host_types')->insert($insert);
    }
}
