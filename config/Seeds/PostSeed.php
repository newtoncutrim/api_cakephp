<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;

class PostSeed extends AbstractSeed
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
        $faker = Factory::create();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'user_id' => $faker->randomNumber(1, 10),
                'created' => $faker->dateTime->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime->format('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('posts');
        $table->insert($data)->save();
    }
}
