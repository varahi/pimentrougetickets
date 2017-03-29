<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'PimentRouge.' . $_EXTKEY,
	'Pimentrougetickets',
	'Piment Rouge Tickets'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($_EXTKEY,'PimentRougeTicketButton','PimentRouge Ticket Button');

// FlexForm
$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . pimentrougetickets;
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .pimentrougetickets. '.xml');
/// FlexForm

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Piment Rouge Tickets');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_ticket', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_ticket.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_ticket');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_category', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_priority', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_priority.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_priority');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_status', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_status.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_status');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_answer', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_answer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_answer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_message', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_message.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_message');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_filereference', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_filereference.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_filereference');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pimentrougetickets_domain_model_site', 'EXT:pimentrougetickets/Resources/Private/Language/locallang_csh_tx_pimentrougetickets_domain_model_site.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pimentrougetickets_domain_model_site');

//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'PimentRouge\\Pimentrougetickets\\Hook\\Core\\DataHandling\\ProcessDataMap';
