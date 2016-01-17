<?php

use Phinx\Migration\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;

class CreateDataSeedMigration extends AbstractMigration
{
    public function up()
    {
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePHP\Populator($faker);

        $populator->addEntity('Users', 50, [
            'first_name' => function () use ($faker) {
                return $faker->firstName();
            },
            'last_name' => function () use ($faker) {
                return $faker->lastName();
            },
            'email' => function () use ($faker) {
                return $faker->safeEmail();
            },
            'password' => function () {
                $hasher = new DefaultPasswordHasher();
                return $hasher->hash('secret');
            },
            'role' => 'user',
            'active' => function() {
                return rand(0, 1);
            },
            'created' => function () use ($faker) {
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            },
            'modified' => function () use ($faker) {
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            }
        ]);

        $populator->execute();
    }
}
