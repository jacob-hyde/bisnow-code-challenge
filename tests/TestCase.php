<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;
use Faker\Generator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Generator
     */
    public Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }
}
