<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd36b2f262090b9bbdbce8eb0fc1572db
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd36b2f262090b9bbdbce8eb0fc1572db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd36b2f262090b9bbdbce8eb0fc1572db::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
