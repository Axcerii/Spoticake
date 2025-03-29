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
                'url' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-24 11:10:37',
                'modified' => '2025-03-24 11:10:37',
            ],
        ];
        parent::init();
    }
}
