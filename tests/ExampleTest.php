<?php

namespace Lacasera\ApiJwtScaffold\Tests;

use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function true_is_true()
    {
        Artisan::call('migrate');
        $this->assertTrue(true);
    }
}
