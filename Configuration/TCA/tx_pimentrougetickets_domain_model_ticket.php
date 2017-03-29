<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket',
		'label' => 'title',
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
		'searchFields' => 'title,project,description,file,cost,category,priority,status,user,answer,image,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('pimentrougetickets') . 'Resources/Public/Icons/tx_pimentrougetickets_domain_model_ticket.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, notice, private, project, description, create_date, cost, category, priority, status, user, admin, image, answer',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, notice, private, project, description, create_date, file, cost, category, priority, status, user, admin, image, answer, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_pimentrougetickets_domain_model_ticket',
				'foreign_table_where' => 'AND tx_pimentrougetickets_domain_model_ticket.pid=###CURRENT_PID### AND tx_pimentrougetickets_domain_model_ticket.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),			
		'notice' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.notice',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),			
		'private' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.private',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),			
		'project' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.project',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
			
		'create_date' => array(
				'exclude' => 1,
				'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.date',
				'config' => array(
					'type' => 'input',
					'size' => 10,
					'eval' => 'datetime',
					'checkbox' => 1,
					'default' => time()
			),
		),			
			
		'file' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.file',
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
		'cost' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.cost',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_category',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'priority' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.priority',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_priority',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.status',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_status',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.user',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'admin' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.admin',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'client' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.to_client',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),					

/*
			'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.image',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_filereference',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
*/
			
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
									'tablenames' => 'tx_pimentrougetickets_domain_model_ticket',
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
									'tablenames' => 'tx_pimentrougetickets_domain_model_ticket',
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
			
			
			'answer' => array(
					'exclude' => 1,
					'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket.answer',
					'config' => array(
							'type' => 'inline',
							'foreign_table' => 'tx_pimentrougetickets_domain_model_answer',
							'foreign_field' => 'ticket',
							'foreign_sortby' => 'crdate',
							'maxitems' => 9999,
							'appearance' => array(
									'collapseAll' => 1,
									'levelLinksPosition' => 'top',
									'showSynchronizationLink' => 1,
									'showPossibleLocalizationRecords' => 1,
									'useSortable' => 1,
									'showAllLocalizationLink' => 1
							),
					),
			
			),			
			
		/*	
		'user' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'category' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'priority' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'status' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		*/	
			
	),
);