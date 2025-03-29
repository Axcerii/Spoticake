<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MusicsFixture
 */
class MusicsFixture extends TestFixture
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
                'duration' => '11:10:32',
                'spotify_id' => 'Lorem ipsum dolor sit amet',
                'album_id' => 1,
                'created' => '2025-03-24 11:10:32',
                'modified' => '2025-03-24 11:10:32',
            ],
        ];
        parent::init();
    }
}
