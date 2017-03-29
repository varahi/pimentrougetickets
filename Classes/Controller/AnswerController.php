<?php
namespace PimentRouge\Pimentrougetickets\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dmitrii Vasilev <dmitry@typo3.ru.net>, PimentRouge
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use PimentRouge\Pimentrougetickets\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \PimentRouge\Pimentrougetickets\Utility\Div;


/**
 * AnswerController
 */
class AnswerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null;
    
    /**
     * configurationManager
     *
     * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager = null;
    
    /**
     * accessControll
     *
     * @var \PimentRouge\Pimentrougetickets\Service\AccessControlService
     * @inject
     */
    protected $accessControllService;
    
    /**
     * Misc Functions
     *
     * @var \PimentRouge\Pimentrougetickets\Utility\Div
     * @inject
     */
    protected $div; 
    
    /**
     * statusRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\StatusRepository
     * @inject
     */
    protected $statusRepository = NULL;    
    
    /**
     * userRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = NULL;
    
    /**
     * ticketRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\TicketRepository
     * @inject
     */
    protected $ticketRepository = NULL;
    
    /**
     * answerRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\AnswerRepository
     * @inject
     */
    protected $answerRepository = NULL;   
    
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $answers = $this->answerRepository->findAll();
        $this->view->assign('answers', $answers);
    }
    
    /**
     * action show
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer
     * @return void
     */
    public function showAction(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer)
    {
        $this->view->assign('answer', $answer);
    }
    
    
    /**
     *
     * @return void
     */
    protected function initializeNewAction() {
    	#$propertyMappingConfiguration = $this->arguments['ticket']->getPropertyMappingConfiguration();
    	#$propertyMappingConfiguration->allowAllProperties();
    }    
    
        
    /**
     * action new
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function newAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		 \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {
    	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    	$this->view->assign('user', $user);
    	$this->view->assign('ticket', $ticket);
    	$this->view->assign('status', $this->statusRepository->findAll());
    }

    
    /**
     *
     * @return void
     */
    protected function initializeAction() {
    	$propertyMappingConfiguration = $this->arguments['newAnswer']->getPropertyMappingConfiguration();
    	$propertyMappingConfiguration->allowAllProperties();
    	$this->setTypeConverterConfigurationForImageAnswerUpload('newAnswer');
    }    
    
    /**
     *
     * @return void
     */
    protected function initializeCreateAction() {
    	$propertyMappingConfiguration = $this->arguments['newAnswer']->getPropertyMappingConfiguration();
    	$propertyMappingConfiguration->allowAllProperties();   	
    	$this->setTypeConverterConfigurationForImageAnswerUpload('newAnswer');
    	//$propertyMappingConfiguration->allowProperties('ticket');
    }  
    
    
    /**
     * action create
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $newAnswer
     * @return void
     */
    public function createAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Answer $newAnswer)
    {    	
    	$this->view->assign('settings', $this->settings);
    	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    	$this->view->assign('user', $user);
    	$this->view->assign('ticket', $ticket);
    	
    	$newAnswer->setUser($user);
    	$newAnswer->setTicket($ticket);
    	$this->persistenceManager->persistAll();
    	$this->flashMessageService('tx_pimentrougetickets.flash.answer_added','tx_pimentrougetickets.flash.status','OK' );
    	
    	// Send mail
    	$this->div->sendEmail(
    			/* $template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message */
    			'AnswerNotificationCreate',
    			// To Email
    			$ticket->getAdmin()->getEmail(),
    			$ticket->getUser()->getEmail(),
    			//$this->settings['toEmail'],
    			// From Email
    			$user->getEmail(),
    			// Subject
    			$this->settings['createAnswerSubject'],
    			// Message
    			array('ticket' => $ticket,  'answer' => $newAnswer, 'user' => $user),
    			$message
    			);    	
    	
    	$this->answerRepository->add($newAnswer);	
    	$this->redirect('ticketsList','User',null,array(), '10');
    }
    
    
    /**
     * action create
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $newAnswer
     * @return void
     */
    public function createByAdminAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Answer $newAnswer)
    {
    	$this->view->assign('settings', $this->settings);
    	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    	$this->view->assign('user', $user);
    	$this->view->assign('ticket', $ticket);  	 
    	$newAnswer->setUser($user);
    	$newAnswer->setTicket($ticket);
    	$this->persistenceManager->persistAll();
    	$this->flashMessageService('tx_pimentrougetickets.flash.answer_added','tx_pimentrougetickets.flash.status','OK' );
    	 
    	// Send mail
    	$this->div->sendEmail(
    			/* $template, $receiver, $sender, $subject, $variables = array(), $message */
    			'AnswerNotificationCreate',
    			// To Email
    			$ticket->getUser()->getEmail(),
    			//$ticket->getAdmin()->getEmail(),
    			$this->settings['fromEmail'],
    			// From Email
    			$user->getEmail(),
    			// Subject
    			$this->settings['createAnswerSubject'],
    			// Message
    			array('ticket' => $ticket,  'answer' => $newAnswer, 'user' => $user),
    			$message
    			);
    	 
    	$this->answerRepository->add($newAnswer);
    	$this->redirect('','',null,array(), '27');
    }    
    
    
    /**
     * action edit
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer
     * @ignorevalidation $answer
     * @return void
     */
    public function editAction(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer)
    {
        $this->view->assign('answer', $answer);
    }
    
    
    /**
     * Set TypeConverter option for image upload
     */
    public function initializeUpdateAction() {
    	$this->setTypeConverterConfigurationForImageAnswerUpload('answer');
    }   
    
    /**
     * action update
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer
     * @return void
     */
    public function updateAction(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->answerRepository->update($answer);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer
     * @return void
     */
    public function deleteAction(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->answerRepository->remove($answer);
        $this->redirect('list');
    }

    
    
    /**
     *
     */
    protected function setTypeConverterConfigurationForImageAnswerUpload($argumentName) {
    	$uploadConfiguration = array(
    			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
    			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
    	);
    	/** @var PropertyMappingConfiguration $newImageConfiguration */
    	$newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
    	$newExampleConfiguration->forProperty('image')
    	->setTypeConverterOptions(
    			'PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceAnswerConverter',
    			$uploadConfiguration
    			);
    	$newExampleConfiguration->forProperty('imageCollection.0')
    	->setTypeConverterOptions(
    			'PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceAnswerConverter',
    			$uploadConfiguration
    			);
    }  
    
    
    /**
     * @param \string $messageKey
     * @param \string $statusKey
     * @param \string $level
     */
    function flashMessageService($messageKey, $statusKey, $level) {
    	switch ($level) {
    		case "NOTICE":
    			$level = AbstractMessage::NOTICE;
    			break;
    		case "INFO":
    			$level = AbstractMessage::INFO;
    			break;
    		case "OK":
    			$level = AbstractMessage::OK;
    			break;
    		case "WARNING":
    			$level = AbstractMessage::WARNING;
    			break;
    		case "ERROR":
    			$level = AbstractMessage::ERROR;
    			break;
    	}
    
    	$this->addFlashMessage(LocalizationUtility::translate($messageKey, 'pimentrougetickets'),
    			LocalizationUtility::translate($statusKey, 'pimentrougetickets'),
    			$level,
    			TRUE
    			);
    }    
    
    
}