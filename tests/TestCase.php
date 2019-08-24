<?php

namespace Tests;

use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $migrated = false;

    /**
     * @var Faker
     */
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('config:clear');

        $this->faker = new Faker();

        if (!$this->migrated) {
            $this->artisan('migrate');
            $this->migrated = true;
        }

        $this->beforeApplicationDestroyed(function () {
            $this->down();
            $this->migrated = false;
        });
    }

    public function down(): void
    {
        $driverName = DB::getDriverName();
        $this->setForeignKeyOff($driverName);
        $this->truncateTables();
        $this->setForeginKeyOn($driverName);
    }

    private function setForeignKeyOff(string $driverName): void
    {
        switch ($driverName) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }
    }

    public function truncateTables(): void
    {
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            //if you don't want to truncate migrations
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }
    }

    private function setForeginKeyOn(string $driverName): void
    {
        switch ($driverName) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = ON');
                break;
        }
    }
}
