<?php

use PhpCsFixer\Config;

$rules = [
    '@PSR2' => true,
    '@PSR12' => true,
    '@PhpCsFixer' => true,
    '@Symfony' => true,
    '@DoctrineAnnotation' => true,
    '@PHP84Migration' => true,
    'no_superfluous_phpdoc_tags' => [
        'allow_hidden_params' => false,
        'allow_mixed' => false,
        'allow_unused_params' => false,
        'remove_inheritdoc' => true
    ],
    'linebreak_after_opening_tag' => true,
    'phpdoc_to_comment' => false,
    'php_unit_test_class_requires_covers' => false,
    'single_line_comment_style' => false,
    'phpdoc_var_without_name' => false,
    'phpdoc_summary' => false,
    'phpdoc_types_order' => [
        'null_adjustment' => 'always_last',
    ],
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'phpdoc_align' => [
        'align' => 'left',
    ],
    'list_syntax' => [
        'syntax' => 'short',
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'class_definition' => [
        'single_line' => false,
        'multi_line_extends_each_single_line' => true,
    ],
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'phpdoc_no_alias_tag' => false,
    'single_line_throw' => false,
    'yoda_style' => false,
    'explicit_string_variable' => false,
    'simple_to_complex_string_variable' => false,
    'multiline_comment_opening_closing' => false,
    'phpdoc_order' => [
        'order' => ['param', 'return', 'throws'],
    ],
    'phpdoc_separation' => [
        'groups' => [
            ['param*'],
            ['return*'],
            ['throws*'],
            ['ORM\\*', 'Table*', 'Entity*', 'Id*', 'GeneratedValue*', 'Column*'],
        ],
        'skip_unlisted_annotations' => true,
    ],
    'php_unit_internal_class' => false,
    'phpdoc_tag_type' => [
        'tags' => ['inheritDoc' => 'annotation']
    ],
    'global_namespace_import' => [
        'import_classes' => true,
        'import_constants' => null,
        'import_functions' => null,
    ],
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'none',
            'method' => 'one',
            'property' => 'none',
            'trait_import' => 'none',
            'case' => 'none',
        ],
    ],
    'single_line_empty_body' => false,
    'fully_qualified_strict_types' => [
        'import_symbols' => true
    ],
    'statement_indentation' => false,
    'long_to_shorthand_operator' => false,
    'phpdoc_scalar' => true,
    'blank_line_before_statement' => [
        'statements' => ['declare', 'return', 'try', 'foreach', 'switch', 'while']
    ],
    'string_implicit_backslashes' => false,
];

return (new Config())
    ->setRules($rules)
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect());
