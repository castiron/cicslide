<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CIC.'.$_EXTKEY,
	'Slide',
	array(
		'Slide' => 'show',
		
	),
	// non-cacheable actions
	array(
		'Slide' => '',
		
	)
);

?>