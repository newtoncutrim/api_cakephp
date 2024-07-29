<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class User extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
              ])
              ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => false,
              ])
              ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
              ])
              ->addColumn('created_at', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
              ])
              ->addColumn('updated_at', 'datetime', [
                'update' => 'CURRENT_TIMESTAMP',
            ]);
        $table->addIndex('email', ['unique' => true]);
        $table->create();
    }
}
