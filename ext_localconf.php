<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'PimentRouge.' . $_EXTKEY,
	'Pimentrougetickets',
	array(
		'User' => 'list, privateList, ticketsListAction, adminTicketsListAction, show, new, create, edit, update, delete',
		'Ticket' => 'list, show, new, create, createByAdmin, edit, update, delete',
		'Category' => 'list',
		'Priority' => 'list',
		'Status' => 'list',
		'Answer' => 'list, show, new, create, createByAdmin, edit, update, delete',
		'Message' => 'list, show, new, create, delete',
		
	),
	// non-cacheable actions
	array(
		'User' => 'create, update, delete, ticketList, archiveList, profile',
		'Ticket' => 'create, update, delete, list, createByAdmin',
		'Category' => '',
		'Priority' => '',
		'Status' => '',
		'Answer' => 'create, createByAdmin, update, delete',
		'Message' => 'create, delete',
		
	)
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'PimentRouge.' . $_EXTKEY,
		'PimentRougeTicketButton',
		array(
				'Ticket' => 'ticketButton',
		),
		// non-cacheable actions
		array(
				'Ticket' => '',
		)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\ObjectStorageConverter');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceAnswerConverter');
//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\ObjectStorageAnswerConverter');
