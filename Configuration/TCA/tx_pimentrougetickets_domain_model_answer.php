<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer',
		'label' => 'answer',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,answer,file,ticket,user,image,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('pimentrougetickets') . 'Resources/Public/Icons/tx_pimentrougetickets_domain_model_answer.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, answer, ticket, user, image',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, answer, ticket, user, image, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_pimentrougetickets_domain_model_answer',
				'foreign_table_where' => 'AND tx_pimentrougetickets_domain_model_answer.pid=###CURRENT_PID### AND tx_pimentrougetickets_domain_model_answer.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
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
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'answer' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.answer',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'file' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.file',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'file',
				array(
					'appearance' => array(
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference'
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						)
					),
					'maxitems' => 1
				)
			),
		),
		'ticket' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.ticket',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_ticket',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.user',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
			
			'image' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.image',
					'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
							'appearance' => array(
									'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
							),
							'maxitems' => 1,
							// custom configuration for displaying fields in the overlay/reference table
							// to use the imageoverlayPalette instead of the basicoverlayPalette
							'foreign_match_fields' => array(
									'fieldname' => 'image',
									'tablenames' => 'tx_pimentrougetickets_domain_model_answer',
									'table_local' => 'sys_file',
							),
							'foreign_types' => array(
									'0' => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									)
							)
					), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
			),
			
			'image_collection' => array(
					'exclude' => 0,
					'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.image_collection',
					'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image_collection', array(
							'appearance' => array(
									'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
							),
							// custom configuration for displaying fields in the overlay/reference table
							// to use the imageoverlayPalette instead of the basicoverlayPalette
							'foreign_match_fields' => array(
									'fieldname' => 'image_collection',
									'tablenames' => 'tx_pimentrougetickets_domain_model_answer',
									'table_local' => 'sys_file',
							),
							'foreign_types' => array(
									'0' => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									),
									\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
											'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
									)
							)
					), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
			),			
			
			
		/*
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_answer.image',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_filereference',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		*/
		/*
		'user' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'ticket' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		*/	
			
	),
);