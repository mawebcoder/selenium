<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5623f2eea8a488d5e5480ff6d06cc44
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Nizek\\Crawler\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Nizek\\Crawler\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInita5623f2eea8a488d5e5480ff6d06cc44::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5623f2eea8a488d5e5480ff6d06cc44::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita5623f2eea8a488d5e5480ff6d06cc44::$classMap;

        }, null, ClassLoader::class);
    }
}
