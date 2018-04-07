<?php

namespace T1k3\LaravelTranslatable\Tests;


use Orchestra\Testbench\TestCase as BaseTestCase;
use T1k3\LaravelTranslatable\Providers\ServiceProvider as LaravelTranslatableServiceProvider;

/**
 * Class TestCase
 * @package T1k3\LaravelTranslatable\Tests
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * Setup
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setUpFactory();
        $this->setUpDatabase();
    }

    /**
     * Teardown
     */
    public function tearDown()
    {
        $this->artisan('migrate:reset');

        parent::tearDown();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelTranslatableServiceProvider::class,
        ];
    }

    /**
     * Define environment setup
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);
    }
    /**
     * Configure the factory
     */
    private function setUpFactory()
    {
        $this->withFactories(__DIR__ . '/../src/database/factories');
        $this->withFactories(__DIR__ . '/fixtures/database/factories');
    }
    /**
     * Configure the database
     * SQLite
     */
    private function setUpDatabase()
    {
        $this->artisan('migrate', ['--database' => 'testing']);
        $this->artisan('migrate', [
            '--database' => 'testing',
//            '--realpath' => realpath(__DIR__ . '/fixtures/database/migrations'),
            '--path'     => '../../../../tests/fixtures/database/migrations',
        ]);
    }
}