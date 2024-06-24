<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
                'null' => false
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true
            ],
            'cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => 14,
                'null' => true
            ],
            'rg' => [
                'type' => 'VARCHAR',
                'constraint' => 14,
                'null' => true
            ],
            'ie' => [
                'type' => 'VARCHAR',
                'constraint' => 14,
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('phone');
        $this->forge->addUniqueKey('cpf');
        $this->forge->addUniqueKey('cnpj');
        $this->forge->addUniqueKey('rg');
        $this->forge->addUniqueKey('ie');
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
