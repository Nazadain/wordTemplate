<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0e311901ceb00b16ffb92ae6f4f21dd0
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\PhpOffice\\Math\\' => 21,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Math\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/tests/Math',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/src/Math',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e311901ceb00b16ffb92ae6f4f21dd0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e311901ceb00b16ffb92ae6f4f21dd0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0e311901ceb00b16ffb92ae6f4f21dd0::$classMap;

        }, null, ClassLoader::class);
    }
}
