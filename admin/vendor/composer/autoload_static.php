<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit36fc6a4349b3c0c6ef07ac77a41554c8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit36fc6a4349b3c0c6ef07ac77a41554c8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit36fc6a4349b3c0c6ef07ac77a41554c8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
