<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('bootstrap/cache')
    ->exclude('storage')
    ->files();

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'list_syntax' => ['syntax' => 'short'],
    'no_unused_imports' => true,
    'no_extra_blank_lines' => true,
    'trailing_comma_in_multiline' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => ['const', 'class', 'function'],
    ],
    'global_namespace_import' => true,
    'phpdoc_to_comment' => false,
    'phpdoc_align' => true,
    'phpdoc_separation' => false,
])
->setFinder($finder)
->setUsingCache(true);
