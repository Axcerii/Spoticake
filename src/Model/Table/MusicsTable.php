<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Musics Model
 *
 * @property \App\Model\Table\AlbumsTable&\Cake\ORM\Association\BelongsTo $Albums
 *
 * @method \App\Model\Entity\Music newEmptyEntity()
 * @method \App\Model\Entity\Music newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Music> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Music get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Music findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Music patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Music> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Music|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Music saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Music>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Music>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Music>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Music> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Music>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Music>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Music>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Music> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MusicsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('musics');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Albums', [
            'foreignKey' => 'album_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->time('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyTime('duration');

        $validator
            ->scalar('spotify_id')
            ->maxLength('spotify_id', 255)
            ->requirePresence('spotify_id', 'create')
            ->notEmptyString('spotify_id');

        $validator
            ->integer('album_id')
            ->notEmptyString('album_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['album_id'], 'Albums'), ['errorField' => 'album_id']);

        return $rules;
    }
}
