<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class UpdateRequestsTable2 extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('requests');

        // Modifier la colonne stat pour qu'elle soit BOOLEAN avec false par défaut
        $table->changeColumn('state', 'boolean', [
            'default' => false,
            'null' => false
        ]);

        $table->update();
    }
}
