<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddArtistIdToAlbums extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('albums');

        // Ajouter la colonne artist_id
        $table->addColumn('artist_id', 'integer', [
            'null' => false, // Peut être modifié selon ton besoin
        ])
        ->update();
    }
}
