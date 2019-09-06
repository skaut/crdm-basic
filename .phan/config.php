<?php
/**
 * PHAN configuration
 *
 * @package crdm-basic
 */

return [
	'target_php_version'              => '7.3',
	'backward_compatibility_checks'   => false,
	'analyze_signature_compatibility' => true,
	'minimum_severity'                => 0,
	'directory_list'                  => [
		'src',
		'.phan',
		'dist/vendor',
	],
	'exclude_analysis_directory_list' => [
		'dist/vendor/',
	],
	'suppress_issue_types'            => [
	],
	'plugins'                         => [
		'AlwaysReturnPlugin',
		'DuplicateArrayKeyPlugin',
		'PregRegexCheckerPlugin',
		'UnreachableCodePlugin',
		'NonBoolBranchPlugin',
		'NonBoolInLogicalArithPlugin',
		'InvalidVariableIssetPlugin',
		'NoAssertPlugin',
		'DuplicateExpressionPlugin',
		'DollarDollarPlugin',
	],
];
