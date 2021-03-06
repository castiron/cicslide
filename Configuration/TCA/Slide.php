<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_cicslide_domain_model_slide'] = array(
	'ctrl' => $TCA['tx_cicslide_domain_model_slide']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, slidetype, is_lightbox, link, description, class, images, html',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, slidetype, is_lightbox, lightbox_width, lightbox_height, link, description, addclass, images,html,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_cicslide_domain_model_slide',
				'foreign_table_where' => 'AND tx_cicslide_domain_model_slide.pid=###CURRENT_PID### AND tx_cicslide_domain_model_slide.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'is_lightbox' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.isLightbox',
			'config' => array(
				'onChange' => 'reload',
				'type' => 'check',
			),
		),
		'lightbox_width' => array(
			'displayCond' => 'FIELD:is_lightbox:>:0',
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.lightbox_width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
			),
		),
		'lightbox_height' => array(
			'displayCond' => 'FIELD:is_lightbox:>:0',
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.lightbox_height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
			),
		),
		'slidetype' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.slidetype',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_cicslide_domain_model_type',
				'foreign_table_where' => 'ORDER BY tx_cicslide_domain_model_type.title',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1
			)
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			),
		),
		'addclass' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.addclass',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'link' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.link',
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'images' => Array (
			"exclude" => 0,
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.images',
			"config" => Array (
				'type' => 'group',
				'uploadfolder' => 'uploads/tx_cicslide',
				'show_thumbs' => true,
				'internal_type' => 'file',
				'allowed' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai',
				'max_size' => 10000,
				'size' => 6,
				'maxitems' => 20,
				'minitems' => 0,
				'autoSizeMax' => 30
			)
		),
		'html' => array(
			'label' => 'LLL:EXT:cicslide/Resources/Private/Language/locallang_db.xml:tx_cicslide_domain_model_slide.html',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 5,
			)
		)
	),
);

$TCA['tx_cicslide_domain_model_slide']['ctrl']['requestUpdate'] = $TCA['tx_cicslide_domain_model_slide']['ctrl']['requestUpdate'] ? $TCA['tx_cicslide_domain_model_slide']['ctrl']['requestUpdate'] . ', is_lightbox' : 'is_lightbox';

if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cicslide']['useFal']) {
    $TCA['tx_cicslide_domain_model_slide']['columns']['images']['config'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('images');
}
