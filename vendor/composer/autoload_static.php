<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef5aa3daf606c460f88ca86cbd52b88f
{
    public static $files = array (
        '0214bac41d011ca284143f5aeb544f02' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WeDevs\\Fixer\\' => 13,
            'WeDevs\\Academy\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WeDevs\\Fixer\\' => 
        array (
            0 => __DIR__ . '/..' . '/tareq1988/wp-php-cs-fixer/src',
        ),
        'WeDevs\\Academy\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef5aa3daf606c460f88ca86cbd52b88f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef5aa3daf606c460f88ca86cbd52b88f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitef5aa3daf606c460f88ca86cbd52b88f::$classMap;

        }, null, ClassLoader::class);
    }
}
