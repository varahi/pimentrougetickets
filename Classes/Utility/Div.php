<?php
namespace PimentRouge\Pimentrougetickets\Utility;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class Div {

	/**
	 * configurationManager
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * objectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager;

	/**
	 * Generate and send Email
	 *
	 * @param \string Template file in Templates/Email/
	 * @param \array $receiver Combination of Email => Name
	 * @param \array $receiverCc Combination of Email => Name
	 * @param \array $receiverBcc Combination of Email => Name
	 * @param \array $sender Combination of Email => Name
	 * @param \string $subject Mail subject
	 * @param \array $variables Variables for assignMultiple
	 * @param \string $message
	 * @return \bool Mail was sent?
	 */
	public function sendEmail($template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message) {

		/** @var $emailBodyObject \TYPO3\CMS\Fluid\View\StandaloneView */
		$emailBodyObject = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$emailBodyObject->setTemplatePathAndFilename($this->getTemplatePath('Email/' . $template . '.html'));
		$emailBodyObject->setLayoutRootPaths(array(
				'default' => ExtensionManagementUtility::extPath('pimentrougetickets') . 'Resources/Private/Layouts',
				'specific' => 'fileadmin/template/extensions/pimentrougetickets/Layouts'
		));
		$emailBodyObject->setPartialRootPaths(array(
				'default' => ExtensionManagementUtility::extPath('pimentrougetickets') . 'Resources/Private/Partials',
				'specific' => 'fileadmin/template/extensions/pimentrougetickets/Partials'
		));
		$emailBodyObject->assignMultiple($variables);

		$email = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$email
				->setTo($receiver)
				->setCc($receiverCc)
				->setBcc($receiverBcc)
				->setFrom($sender)
				->setSubject($subject)
				->setCharset($GLOBALS['TSFE']->metaCharset)
				->setBody($emailBodyObject->render(), 'text/html');

		$email->send();

		return $email->isSent();
	}


	/**
	 * Return path and message for a file
	 * 		respect *RootPaths and *RootPath
	 *
	 *@todo Remove this function as soon as StandaloneView supports templaterootpaths ... , maybe TYPO3 6.3 ?
	 *
	 * @param string $relativePathAndmessage e.g. Email/Name.html
	 * @return string
	 */
	public function getTemplatePath($relativePathAndFilename) {
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
				ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
				);
		if (!empty($extbaseFrameworkConfiguration['view']['templateRootPaths'])) {
			foreach ($extbaseFrameworkConfiguration['view']['templateRootPaths'] as $path) {
				$absolutePath = GeneralUtility::getFileAbsFileName($path);
				if (file_exists($absolutePath . $relativePathAndFilename)) {
					$absolutePathAndFilename = $absolutePath . $relativePathAndFilename;
				}
			}
		}
		if (empty($absolutePathAndFilename)) {
			$absolutePathAndFilename = GeneralUtility::getFileAbsFileName(
					'EXT:pimentrougetickets/Resources/Private/Templates/' . $relativePathAndFilename
					);
		}
		return $absolutePathAndFilename;
	}
}