<?php
declare(strict_types=1);

use PostSeed;
use UserSeed;
use ImageSeed;
use Migrations\AbstractSeed;

/**
 * Database seed.
 */
class DatabaseSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeed::class);
        $this->call(PostSeed::class);
        $this->call(ImageSeed::class);
    }
}
