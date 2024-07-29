<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Faker\Factory;

/**
 * User seed.
 */
class UserSeed extends AbstractSeed
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
        $data = [];
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->password,
                'created_at' => $faker->dateTime->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime->format('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
