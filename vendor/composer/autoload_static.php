<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf8359b62816ab30eafbd35cd71c0f92
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf8359b62816ab30eafbd35cd71c0f92::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf8359b62816ab30eafbd35cd71c0f92::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaf8359b62816ab30eafbd35cd71c0f92::$classMap;

        }, null, ClassLoader::class);
    }
}
