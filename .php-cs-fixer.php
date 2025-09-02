<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        // 'ordered_class_elements' => ['sort_algorithm' => 'alpha'],
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'none',
                'const' => 'none',
            ],
        ],
        'no_extra_blank_lines' => [
            'tokens' => ['extra', 'curly_brace_block', 'use', 'throw', 'return'],
        ],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
    ])
    ->setFinder($finder);
