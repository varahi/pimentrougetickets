<?php 

$tmp_pimentrougetickets_columns = array(
	'sorting' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.sorting',
		'config' => array(
			'type' => 'input',
			'size' => 5,
			'eval' => 'int'
		),
	),				
	'username' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.username',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'email' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.email',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'first_name' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.first_name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'last_name' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.last_name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'image' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.image',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'image',
			array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
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
			),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
	),
	'ticket' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.ticket',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_pimentrougetickets_domain_model_ticket',
			'foreign_field' => 'user',
			'foreign_sortby' => 'sorting',
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
	'delegated_ticket' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.delegated_ticket',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_pimentrougetickets_domain_model_ticket',
			//'foreign_table_where' => "AND tx_pimentrougetickets_domain_model_ticket.private LIKE '1'",
			'foreign_field' => 'admin',
			'foreign_sortby' => 'sorting',
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
	'answer' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_user.answer',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_pimentrougetickets_domain_model_answer',
			'foreign_field' => 'user',
			'foreign_sortby' => 'sorting',
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
		
	'site' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_site',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_pimentrougetickets_domain_model_site',
				'foreign_field' => 'user',
				'foreign_sortby' => 'sorting',
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
		
);

//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_pimentrougetickets_columns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_pimentrougetickets_columns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCATypes('fe_users','sorting');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCATypes('fe_users','gender','', 'after:name');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCATypes('fe_users','--div--;LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_ticket,username,email,ticket,delegated_ticket;;;;1-1-1');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_ticket');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCATypes('fe_users','--div--;LLL:EXT:pimentrougetickets/Resources/Private/Language/locallang_db.xlf:tx_pimentrougetickets_domain_model_site,username,email,site;;;;1-1-1');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_site');