<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR2' => true,
        'psr_autoloading' => true,
    ])
    ->setFinder($finder); 