<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "id_pelanggan" => [
                    'type' => 'int',
                    'constraint' => 11,
                    'auto_increment' => true,
                    'null' => false,
                ],
                "nama_pelanggan" => [
                    'type' => 'varchar',
                    'constraint' => 255,
                ],
                "alamat" => [
                    'type' => 'varchar',
                    'constraint' => 255,
                ],
                "nomor_tlpn" => [
                    'type' => 'int',
                    'constraint' => 20,
                ],
                "created_at" => [
                    'type' => 'datetime',
                    'null' => true,
                ],
                "updated_at" => [
                    'type' => 'datetime',
                    'null' => true,
                ],
                "deleted_at" => [
                    'type' => 'datetime',
                    'null' => true,
                ],
            ]
        );
        $this->forge->addPrimaryKey("id_pelanggan");
        $this->forge->createTable("tb_pelanggan");
    }

    public function down()
    {
        //
    }
}
