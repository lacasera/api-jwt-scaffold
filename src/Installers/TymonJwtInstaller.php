<?php
namespace Lacasera\ApiJwtScaffold\Installers;

use Illuminate\Console\DetectsApplicationNamespace;

class TymonJwtInstaller extends InstallerContract
{
    use DetectsApplicationNamespace;

    protected $commands = [
        'vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"',
        'jwt:secret'
    ];

    protected $filesToCopy = [
        'model/User.stub' => 'User.php',
        'controllers/AuthController.stub' => 'Http/Controllers/Auth/AuthController.php',
        'controllers/RegisterController.stub' => 'Http/Controllers/Auth/RegisterController.php'
    ];

    public function copyFiles()
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
            file_get_contents(__DIR__."/stubs/tymon/$file")
        );
    }

    public function scaffold()
    {
        if (!class_exists('Tymon\JWTAuth\Claims\Subject')) {

            $this->installPackage('tymon/jwt-auth ^1.0.0-rc.3');
        }

        $this->runCommands($this->commands);

        $this->copyFiles();

        return true;
    }
}
