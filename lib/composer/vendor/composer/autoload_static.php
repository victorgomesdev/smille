<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite4b4327eeec2c75342ee6cfc8f0eb0c0
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../../model',
        ),
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../../class',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite4b4327eeec2c75342ee6cfc8f0eb0c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite4b4327eeec2c75342ee6cfc8f0eb0c0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite4b4327eeec2c75342ee6cfc8f0eb0c0::$classMap;

        }, null, ClassLoader::class);
    }
}
