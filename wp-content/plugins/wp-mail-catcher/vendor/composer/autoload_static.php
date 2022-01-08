<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3c979e7cedf8d561e297795d45f00f40
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WpMailCatcher\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WpMailCatcher\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3c979e7cedf8d561e297795d45f00f40::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3c979e7cedf8d561e297795d45f00f40::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}