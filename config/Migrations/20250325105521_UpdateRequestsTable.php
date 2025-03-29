<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class UpdateRequestsTable extends BaseMigration
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
        $table = $this->table('requests');

        // Supprimer les anciennes colonnes
        $table->removeColumn('artist_id')
              ->removeColumn('album_id');

        // Ajouter une colonne 'type' ENUM avec les valeurs possibles
        $table->addColumn('type', 'enum', [
            'values' => ['artist', 'album', 'music'],
            'default' => 'artist',
            'null' => false
        ]);

        // Appliquer les changements
        $table->update();
    }
}
