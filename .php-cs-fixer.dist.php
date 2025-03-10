<?php

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

if (PHP_SAPI !== 'cli') {
    die('CLI only.');
}

$finder = (new PhpCsFixer\Finder())
    ->exclude('vendor')
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setFinder($finder)
    ->setRules([
        '@DoctrineAnnotation' => true,
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_after_opening_tag' => true,
        'braces_position' => true,
        'cast_spaces' => ['space' => 'none'],
        'compact_nullable_type_declaration' => true,
        'concat_space' => ['spacing' => 'one'],
        'control_structure_braces' => true,
        'control_structure_continuation_position' => true,
        'declare_equal_normalize' => ['space' => 'none'],
        'declare_parentheses' => true,
        'declare_strict_types' => true,
        'dir_constant' => true,
        'header_comment' => [
            'header' => 'FINE granularity DIFF'
                . chr(10) . chr(10) . '(c) 2011 Raymond Hill (http://raymondhill.net/blog/?p=441)'
                . chr(10) . '(c) 2013 Robert Crowe (http://cogpowered.com)'
                . chr(10) . '(c) 2021 Christian Kuhn'
                . chr(10). chr(10) . 'For the full copyright and license information, please view'
                . chr(10) . 'the LICENSE file that was distributed with this source code.',
        ],
        'lowercase_cast' => true,
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'modernize_types_casting' => true,
        'native_function_casing' => true,
        'new_with_parentheses' => true,
        'no_alias_functions' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_multiple_statements_per_line' => true,
        'no_null_property_initialization' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_superfluous_elseif' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_whitespace_in_blank_line' => true,
        'nullable_type_declaration' => [
            'syntax' => 'question_mark',
        ],
        'nullable_type_declaration_for_default_null_value' => true,
        'ordered_imports' => true,
        'php_unit_construct' => ['assertions' => ['assertEquals', 'assertSame', 'assertNotEquals', 'assertNotSame']],
        'php_unit_mock_short_will_return' => true,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'phpdoc_no_access' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_no_package' => true,
        'phpdoc_scalar' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_types_order' => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],
        'return_type_declaration' => ['space_before' => 'none'],
        'single_quote' => true,
        'single_line_comment_style' => ['comment_types' => ['hash']],
        'single_space_around_construct' => true,
        'single_trait_insert_per_statement' => true,
        'statement_indentation' => true,
        'type_declaration_spaces' => true,
        'whitespace_after_comma_in_array' => true,
    ]);
