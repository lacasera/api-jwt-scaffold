<?php

namespace Lacasera\ApiJwtScaffold\Tests;

use Lacasera\ApiJwtScaffold\ApiJwtScaffold;
use Lacasera\ApiJwtScaffold\Installers\{
    LaravelPassportInstaller,
    TymonJwtInstaller
};
use PHPUnit\Framework\TestCase;

class ApiJwtScaffoldTest extends TestCase
{
    /** @test */
    public function should_return_the_appropriate_class_to_use_given_a_package()
    {
        $scaffolder = new ApiJwtScaffold;

        $expected = $scaffolder->getPackageClass('laravel-passport');

        $this->assertEquals($expected, "Lacasera\ApiJwtScaffold\Installers\LaravelPassportInstaller");
    }

    /**
     *@test
     * @expectedException \Exception
     * @expectedExceptionMessage Lacasera\ApiJwtScaffold\Installers\FooBarInstaller does not exist
     */
    public function should_throw_error_if_scaffolding_class_is_not_found()
    {
        ( new ApiJwtScaffold)->getPackageClass('foo-bar');
    }

    /** *@test * */
    public function should_scaffold_api_authentication_using_laravel_passport()
    {
        $mock = \Mockery::mock(LaravelPassportInstaller::class)->makePartial();
        $mock->shouldReceive('installPackage')->once()->andReturn(true);
        $mock->shouldReceive('runCommands')->once();
        $mock->shouldReceive('copyFiles')->once();

        $res = $mock->scaffold();
        $this->assertTrue($res);
    }

    /** *@test * */
    public function should_scaffold_api_authentication_using_tymon_jwt()
    {
        $mock = \Mockery::mock(TymonJwtInstaller::class)->makePartial();
        $mock->shouldReceive('installPackage')->once()->andReturn(true);
        $mock->shouldReceive('runCommands')->once();
        $mock->shouldReceive('copyFiles')->once();

        $res = $mock->scaffold();
        $this->assertTrue($res);
    }
}
