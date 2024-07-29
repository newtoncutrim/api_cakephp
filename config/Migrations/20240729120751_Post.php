<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Post extends AbstractMigration
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
        $table = $this->table('posts');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('body', 'text', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('user_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
        ])
        ->addColumn('updated_at', 'datetime', [
            'update' => 'CURRENT_TIMESTAMP',
        ])
        ->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
        ])
        ->create();
    }
}
