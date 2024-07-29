<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ImagesFixture
 */
class ImagesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'path' => 'Lorem ipsum dolor sit amet',
                'post_id' => 1,
                'created_at' => '2024-07-29 16:23:05',
                'updated_at' => '2024-07-29 16:23:05',
            ],
        ];
        parent::init();
    }
}
