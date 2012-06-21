<?php

########################################################################
# Extension Manager/Repository config file for ext "cicslide".
#
# Auto generated 15-06-2012 12:18
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'CIC Slide',
	'description' => 'Generic slideshow/hero extension.',
	'category' => 'plugin',
	'author' => 'Michael McManus',
	'author_email' => 'michael@castironcoding.com',
	'author_company' => 'CIC',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '1',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			'cicbase' => '0.1.1',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:20:{s:13:"changelog.txt";s:4:"4e34";s:12:"ext_icon.gif";s:4:"8343";s:17:"ext_localconf.php";s:4:"7821";s:14:"ext_tables.php";s:4:"15bd";s:14:"ext_tables.sql";s:4:"82c9";s:38:"Classes/Controller/SlideController.php";s:4:"8ad3";s:30:"Classes/Domain/Model/Slide.php";s:4:"c73b";s:45:"Classes/Domain/Repository/SlideRepository.php";s:4:"6c00";s:34:"Configuration/FlexForms/plugin.xml";s:4:"25a5";s:27:"Configuration/TCA/Slide.php";s:4:"2dd7";s:38:"Configuration/TypoScript/constants.txt";s:4:"1c6e";s:34:"Configuration/TypoScript/setup.txt";s:4:"4de1";s:40:"Resources/Private/Language/locallang.xml";s:4:"6194";s:75:"Resources/Private/Language/locallang_csh_tx_cicslide_domain_model_slide.xml";s:4:"e13a";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"4a43";s:38:"Resources/Private/Layouts/Default.html";s:4:"cac0";s:48:"Resources/Private/Partials/Slide/Properties.html";s:4:"325b";s:43:"Resources/Private/Templates/Slide/Show.html";s:4:"7a12";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:57:"Resources/Public/Icons/tx_cicslide_domain_model_slide.gif";s:4:"8343";}',
);

?>