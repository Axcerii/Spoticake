<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Follows Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Follow newEmptyEntity()
 * @method \App\Model\Entity\Follow newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Follow> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Follow get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Follow findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Follow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Follow> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Follow|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Follow saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Follow>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Follow>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Follow>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Follow> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Follow>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Follow>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Follow>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Follow> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FollowsTable extends Table
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

        $this->setTable('follows');
        $this->setDisplayField('entity_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('post_id')
            ->requirePresence('post_id', 'create')
            ->notEmptyString('post_id');

        $validator
            ->scalar('entity_type')
            ->maxLength('entity_type', 255)
            ->requirePresence('entity_type', 'create')
            ->notEmptyString('entity_type');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
