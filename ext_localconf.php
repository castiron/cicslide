<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
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

Tx_Extbase_Utility_Extension::configurePlugin(
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