<?php

use PhpCsFixer\Config;
use Symfony\Component\Finder\Finder;

$finder = Finder::create()
    ->in(__DIR__ . '/app')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->notPath([
        '/app/frontend',
        '/var/',
        '/vendor/'
    ])
;

return Config::create()
    ->setRules([
        '@PSR2' => true
    ])
    ->setFinder($finder);