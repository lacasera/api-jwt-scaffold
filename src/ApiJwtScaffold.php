<?php

namespace Lacasera\ApiJwtScaffold;

class ApiJwtScaffold
{

    public function setup(string $packageToUse)
    {
        return app()->make($this->getPackageClass($packageToUse))
            ->scaffold();
    }

    public function getPackageClass(string $packageToUse)
    {
        $packageName = studly_case($packageToUse);

        $installerClass = "Lacasera\\ApiJwtScaffold\Installers\\{$packageName}Installer";

        if (!class_exists($installerClass)) {
            throw new \Exception("$installerClass does not exist");
        }

        return $installerClass;
    }
}
