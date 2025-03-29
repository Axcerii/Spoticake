<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FavoritesFixture
 */
class FavoritesFixture extends TestFixture
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
                'user_id' => 1,
                'post_id' => 1,
                'entity_type' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-24 11:10:41',
                'modified' => '2025-03-24 11:10:41',
            ],
        ];
        parent::init();
    }
}
