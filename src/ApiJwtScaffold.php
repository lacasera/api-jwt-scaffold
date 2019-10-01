<?php

namespace Lacasera\ApiJwtScaffold;

class ApiJwtScaffold
{

    /**
     * @param string $packageToUse
     * @return mixed
     * @throws \Exception
     */
    public function setup(string $packageToUse)
    {
        return app()->make($this->getPackageClass($packageToUse))
            ->scaffold();
    }

    /**
     * @param string $packageToUse
     * @return string
     * @throws \Exception
     */
    public function getPackageClass(string $packageToUse)
    {
        $packageName = $this->getInstallerClassName($packageToUse);

        $installerClass = "Lacasera\\ApiJwtScaffold\Installers\\{$packageName}Installer";

        if (!class_exists($installerClass)) {
            throw new \Exception("$installerClass does not exist");
        }

        return $installerClass;
    }

    /**
     * @param string $package
     * @return mixed
     */
    private function getInstallerClassName(string $package)
    {
        $packageName = ucwords(str_replace(['-', '_'], ' ', $package));

        return str_replace(' ', '', $packageName);
    }
}
