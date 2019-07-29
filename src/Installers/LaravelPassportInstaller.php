<?php
namespace Lacasera\ApiJwtScaffold\Installers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\DetectsApplicationNamespace;

class LaravelPassportInstaller extends InstallerInterface
{
    use DetectsApplicationNamespace;

    protected $command;

    protected $filesToCopy = [
        'model/User.stub' => 'User.php',
        'providers/AuthServiceProvider.stub' => 'Providers/AuthServiceProvider.php',
        'controllers/LoginController.stub' => 'Http/Controllers/Auth/LoginController.php',
        'controllers/RegisterController.stub' => 'Http/Controllers/Auth/RegisterController.php'
    ];

    protected $commands = [
        'migrate',
        'passport:install',
        'passport:keys',
        //'passport:client --personal'
    ];

    /**
     * install laravel-passport package using composer
     */
    protected function installPackage()
    {
        if (!class_exists("Laravel\Passport\Client")) {
            return $this->terminal('composer require laravel/passport');
        }

        return true;
    }

    /**
     * copy files from stubs/passport to their appropriate locations
     */
    protected function copyFiles(): void
    {
        file_put_contents(
            config_path('auth.php'),
            $this->compileFileStub('config/auth.stub')
        );

        foreach ($this->filesToCopy as $stub => $file) {
            file_put_contents(
                app_path($file),
                $this->compileFileStub($stub)
            );
        }

    }

    /**
     * run additional commands needed by passport
     */
    protected function runCommands()
    {
        foreach ($this->commands as $cmd){
            Artisan::call($cmd);
        }

//        Artisan::call('passport:client --personal');
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function compileFileStub($file)
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__."/stubs/laravel-passport/$file")
        );
    }


    public function scaffold(): void
    {
        $this->installPackage();

        $this->runCommands();

        $this->copyFiles();
    }

}
