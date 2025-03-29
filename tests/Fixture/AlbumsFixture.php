<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'published' => '2025-03-24',
                'genre' => 'Lorem ipsum dolor sit amet',
                'image_id' => 1,
                'visibility' => 1,
                'created' => '2025-03-24 11:10:27',
                'modified' => '2025-03-24 11:10:27',
            ],
        ];
        parent::init();
    }
}
