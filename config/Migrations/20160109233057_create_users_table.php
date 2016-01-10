<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('first_name', 'string', array('limit' => 100))
              ->addColumn('last_name', 'string', array('limit' => 100))
              ->addColumn('email', 'string', array('limit' => 100))
              ->addColumn('password', 'string')
              ->addColumn('role', 'enum', array('values' => 'admin, user'))
              ->addColumn('active', 'boolean')
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();
    }
}
