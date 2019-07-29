<?php

namespace Lacasera\ApiJwtScaffold\Installers;

abstract class InstallerInterface
{

    abstract function scaffold();

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
