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
        $packageName = $this->getInstallerClassName($packageToUse);

        $installerClass = "Lacasera\\ApiJwtScaffold\Installers\\{$packageName}Installer";

        if (!class_exists($installerClass)) {
            throw new \Exception("$installerClass does not exist");
        }

        return $installerClass;
    }

    private function getInstallerClassName(string $package)
    {
        $packageName = ucwords(str_replace(['-', '_'], ' ', $package));

        return str_replace(' ', '', $packageName);
    }
}
