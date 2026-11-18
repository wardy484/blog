<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMix();
    }

    protected function tearDown(): void
    {
        // jcc/laravel-vote calls Model::unguard() on every vote and never restores it.
        Model::reguard();

        parent::tearDown();
    }
}
