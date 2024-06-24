<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseRequestsTable extends Migration
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
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 2,
                'null' => false
            ],
            'price' => [
                'type' => 'DECIMAL',
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['open', 'paid', 'canceled'],
                'default' => 'open'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('customer_id', 'customers', 'id');
        $this->forge->addForeignKey('product_id', 'products', 'id');

        $this->forge->createTable('purchase_requests');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_requests');
    }
}
