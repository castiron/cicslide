<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Slide',
	'CIC Slide'
);

/********************************************************************************************
 *	PLUGIN FLEXFORM CONF
 *******************************************************************************************/
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_slide';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/plugin.xml');



t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'CIC Slide');

t3lib_extMgm::addLLrefForTCAdescr('tx_cicslide_domain_model_slide', 'EXT:cicslide/Resources/Private/Language/locallang_csh_tx_cicslide_domain_model_slide.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_cicslide_domain_model_slide');
$TCA['tx_cicslide_domain_model_slide'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Slide.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_cicslide_domain_model_slide.gif'
	),
);

?>