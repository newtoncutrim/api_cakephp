<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;
use Faker\Factory;

/**
 * Image seed.
 */
class ImageSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $data = [];

        $postsTable = TableRegistry::getTableLocator()->get('Posts');
        $query = $postsTable->find()->select(['id']);
        $postIds = $query->all()->extract('id')->toArray();


        if (empty($postIds)) {
            throw new \RuntimeException('No posts found in the database. Seed the posts table first.');
        }

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'path' => $faker->imageUrl(),
                'post_id' => $faker->randomElement($postIds),
                'created_at' => $faker->dateTime->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime->format('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('images');
        $table->insert($data)->save();
    }
}
