<?php

namespace Lacasera\ApiJwtScaffold;

class ApiJwtScaffold
{

    public function setup(string $packageToUse)
    {
        $installer = app()->make($this->getPackageClass($packageToUse));
        return $installer->scaffold();
    }

    protected function getPackageClass(string $packageToUse)
    {
        $packageName = studly_case($packageToUse);

        $installerClass = "Lacasera\\ApiJwtScaffold\Installers\\{$packageName}Installer";

        if (!class_exists($installerClass)) {
            throw new \Exception("$installerClass does not exist");
        }

        return $installerClass;
    }
}
