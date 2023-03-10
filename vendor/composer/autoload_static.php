<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0d86080b2ab7b1b3ddc9b2f43c649f7a
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WilliamCosta\\DotEnv\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WilliamCosta\\DotEnv\\' => 
        array (
            0 => __DIR__ . '/..' . '/william-costa/dot-env/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0d86080b2ab7b1b3ddc9b2f43c649f7a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0d86080b2ab7b1b3ddc9b2f43c649f7a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0d86080b2ab7b1b3ddc9b2f43c649f7a::$classMap;

        }, null, ClassLoader::class);
    }
}
