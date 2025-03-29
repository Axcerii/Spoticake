<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Albums Model
 *
 * @property \App\Model\Table\ImagesTable&\Cake\ORM\Association\BelongsTo $Images
 * @property \App\Model\Table\MusicsTable&\Cake\ORM\Association\HasMany $Musics
 * @property \App\Model\Table\RequestsTable&\Cake\ORM\Association\HasMany $Requests
 *
 * @method \App\Model\Entity\Album newEmptyEntity()
 * @method \App\Model\Entity\Album newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Album> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Album get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Album findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Album patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Album> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Album|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Album saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Album>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Album>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Album>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Album> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Album>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Album>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Album>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Album> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlbumsTable extends Table
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

        $this->setTable('albums');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Images', [
            'foreignKey' => 'image_id',
            'joinType' => 'INNER',
        ]);
        
        $this->hasMany('Musics', [
            'foreignKey' => 'album_id',
        ]);

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER', // Modifiable selon ton besoin
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
            ->date('published')
            ->requirePresence('published', 'create')
            ->notEmptyDate('published');

        $validator
            ->scalar('genre')
            ->maxLength('genre', 255)
            ->requirePresence('genre', 'create')
            ->notEmptyString('genre');

        $validator
            ->integer('image_id')
            ->allowEmptyString('image_id');

        $validator
            ->boolean('visibility')
            ->requirePresence('visibility', 'create')
            ->notEmptyString('visibility');

        $validator
            ->scalar('spotify_id')
            ->maxLength('spotify_id', 255)
            ->requirePresence('spotify_id', 'create')
            ->notEmptyString('spotify_id');

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
        $rules->add($rules->existsIn(['image_id'], 'Images'), ['errorField' => 'image_id']);

        return $rules;
    }
}
