<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit002c1a14991ae780a34582f8ecc04e69
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Services\\' => 9,
        ),
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'I' => 
        array (
            'Interfaces\\' => 11,
        ),
        'D' => 
        array (
            'Dev2oAno\\Sprint3\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces',
        ),
        'Dev2oAno\\Sprint3\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit002c1a14991ae780a34582f8ecc04e69::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit002c1a14991ae780a34582f8ecc04e69::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit002c1a14991ae780a34582f8ecc04e69::$classMap;

        }, null, ClassLoader::class);
    }
}
