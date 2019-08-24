<?php

namespace Tests;

use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    /**
     * @var Faker
     */
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = new Faker();

//        $this->beforeApplicationDestroyed(function () {
//            $this->app['db']->connection('mongodb')->drop();
//        });
    }
}
