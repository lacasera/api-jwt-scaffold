<?php

namespace Lacasera\ApiJwtScaffold\Installers;

use Illuminate\Support\Facades\Artisan;

abstract class InstallerContract
{

    abstract function scaffold();

    /**
     * install laravel-passport package using composer
     * @param $package
     * @return array|bool
     */
    public function installPackage($package)
    {
        if (!class_exists("Laravel\Passport\Client")) {
            return $this->terminal("composer require ${package}");
        }
        return true;
    }

    /**
     * run additional commands needed by passport
     * @param array $commands
     */
    public function runCommands(array $commands)
    {
        foreach ($commands as $cmd){
            Artisan::call("$cmd -q");
        }
    }

    /**
     * @param $command
     * @return array
     */
    public function terminal($command)
    {
        if(function_exists('system'))
        {
            ob_start();
            system($command , $status);
            $output = ob_get_contents();
            ob_end_clean();
        }

        if(function_exists('passthru'))
        {
            ob_start();
            passthru($command , $status);
            $output = ob_get_contents();
            ob_end_clean();
        }

        if(function_exists('exec'))
        {
            exec($command , $output , $status);
            $output = implode("&quot;n&quot;" , $output);
        }

        if(function_exists('shell_exec'))
        {
            $output = shell_exec($command) ;
        }

        return compact('output', 'status');
    }
}
