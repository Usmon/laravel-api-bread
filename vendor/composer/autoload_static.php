<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb1ff48ffd9d2b55cc1a962450bd7e679
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Usmon\\Microcore\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Usmon\\Microcore\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb1ff48ffd9d2b55cc1a962450bd7e679::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb1ff48ffd9d2b55cc1a962450bd7e679::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb1ff48ffd9d2b55cc1a962450bd7e679::$classMap;

        }, null, ClassLoader::class);
    }
}
