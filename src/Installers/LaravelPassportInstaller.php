<?php
namespace Lacasera\ApiJwtScaffold\Installers;

use Illuminate\Console\DetectsApplicationNamespace;

class LaravelPassportInstaller extends InstallerContract
{
    use DetectsApplicationNamespace;

    /**
     * @var array
     */
    protected $filesToCopy = [
        'model/User.stub' => 'User.php',
        'providers/AuthServiceProvider.stub' => 'Providers/AuthServiceProvider.php',
        'controllers/AuthController.stub' => 'Http/Controllers/Auth/AuthController.php',
        'controllers/RegisterController.stub' => 'Http/Controllers/Auth/RegisterController.php'
    ];

    /**
     * @var array
     */
    protected $commands = [
        'migrate',
        'passport:install',
        'passport:keys',
        'passport:client --personal'
    ];

    /**
     * copy files from stubs/passport to their appropriate locations
     */
    public function copyFiles(): void
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

    /**
     * scaffolds api authentication with laravel passport
     * @return bool
     */
    public function scaffold()
    {
        if (!class_exists("Laravel\Passport\Client")) {
            $this->installPackage('laravel/passport');
        }

        $this->runCommands($this->commands);

        $this->copyFiles();

        return true;
    }
}
