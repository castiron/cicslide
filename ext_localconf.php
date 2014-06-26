<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Slide',
	array(
		'Slide' => 'show',
		
	),
	// non-cacheable actions
	array(
		'Slide' => '',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'SlideUncached',
	array(
		'Slide' => 'show',

	),
	// non-cacheable actions
	array(
		'Slide' => 'show',
	)
);


?>