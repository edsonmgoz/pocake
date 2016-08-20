<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Bookmarks
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bookmarks', [
            'foreignKey' => 'user_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->notEmpty('id', 'create');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name', 'Rellene este campo');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name', 'Rellene este campo');

        $validator
            ->add('email', 'valid', ['rule' => 'email', 'message' => 'Ingrese un correo electrónico válido.'])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Rellene este campo');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Rellene este campo', 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Ya existe un usuario con este correo electrónico.'));
        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->select(['id', 'first_name', 'last_name', 'email', 'password', 'role'])
            ->where(['Users.active' => 1]);

        return $query;
    }

    public function recoverPassword($id)
    {
        $user = $this->get($id);
        return $user->password;
    }

    public function beforeDelete($event, $entity, $options)
    {
        if ($entity->role == 'admin')
        {
            return false;
        }
        return true;
    }
}
