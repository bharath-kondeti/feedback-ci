<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita80421310fe67edf1e524bce67dea92f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita80421310fe67edf1e524bce67dea92f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita80421310fe67edf1e524bce67dea92f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
