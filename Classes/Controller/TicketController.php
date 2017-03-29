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
use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \PimentRouge\Pimentrougetickets\Utility\Div;

//use TYPO3\CMS\Core\Mail\MailMessage;

/**
 * TicketController
 */
class TicketController extends ActionController
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
     * userRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = NULL;
    
    /**
     * categoryRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository = NULL;
    
    /**
     * priorityRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\PriorityRepository
     * @inject
     */
    protected $priorityRepository = NULL;
    
    /**
     * statusRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\StatusRepository
     * @inject
     */
    protected $statusRepository = NULL;
    
    /**
     * answerRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\AnswerRepository
     * @inject
     */
    protected $answerRepository = NULL;
    
    /**
     * ticketRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\TicketRepository
     * @inject
     */
    protected $ticketRepository = NULL;
           
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        //$tickets = $this->ticketRepository->findAll();
        //$this->view->assign('tickets', $tickets);     
    	
    	$this->view->assign('settings', $this->settings);
    	$showClosedTickets = $this->settings['showClosedTickets'];
    	if ($showClosedTickets == 1) {    			
    		$closed = $this->settings['closedTicket'];
    		$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    		$this->view->assign('user', $user);
    		$tickets = $this->ticketRepository->findClosed($closed);
    		$this->view->assign('tickets', $tickets);    			
    		
    	} else {   		
    		$opened = $this->settings['defaultTicketStatus'];
    		$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    		$this->view->assign('user', $user);    	
    		$tickets = $this->ticketRepository->findByAdminAndOpened($user,$opened);
    		//$tickets = $this->ticketRepository->findAll();
    		$this->view->assign('tickets', $tickets);   			
    	}	
   }
   
  
   
   /**
    * action private list
    *
    * @return void
    */
   public function privateListAction()
   {
   	// Get user and group
   	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
   	$this->view->assign('user', $user);
   	$root = $user->getUid();
   	
   	// Get root group from settings
   	$this->view->assign('settings', $this->settings);
   	$rootAdmin = $this->settings['defaultAdminUid'];
   	// Opened status
   	$opened = $this->settings['defaultTicketStatus'];
   	$closed = $this->settings['closedTicket'];
   	
   	$this->view->assign('settings', $this->settings);
   	$showClosedTickets = $this->settings['showClosedTickets'];
   	
   	if ($showClosedTickets == 1) {
   		if ($root == $rootAdmin) {
   			$tickets = $this->ticketRepository->findClosedAndPrivate($closed);
   			$this->view->assign('tickets', $tickets);
   		} else {
   			$tickets = $this->ticketRepository->findByAdminAndPrivateAndClosed($user, $closed);
   			$this->view->assign('tickets', $tickets);
   		}   		
   	} else {
   		if ($root == $rootAdmin) {
   			$tickets = $this->ticketRepository->findOpenedAndPrivate($opened);
   			$this->view->assign('tickets', $tickets);
   		} else {
   			$tickets = $this->ticketRepository->findByAdminAndPrivateAndOpen($user, $opened);
   			$this->view->assign('tickets', $tickets);
   		}   		
   	}  	

   	}   
   
    
    /**
     * action show
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function showAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {
    	// Set answer user
    	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    	$this->view->assign('user', $user);
		
		///$status = $this->statusRepository->findAll();	
		$this->view->assign('status', $status);  	
    	$this->view->assign('ticket', $ticket);
    }
    
    /**
     * action new
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket
     * @return void
     */
    public function newAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket = NULL)
    {
    	if($this->accessControllService->isAccessAllowed($user)) {    		   		
    		$adminGroup = $this->settings['adminGroup'];
    		$userGroup = $this->settings['userGroup']; 
    		
    		$group = $user->getUsergroup();
    		$this->view->assign('group', $group);
    		
    		$newTicket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
    		$this->view->assign('category', $this->categoryRepository->findAll());
    		$this->view->assign('priority', $this->priorityRepository->findAll());
    		$this->view->assign('status', $this->statusRepository->findAll());
    		$this->view->assign('newTicket', $newTicket);
    		$this->view->assign('user', $user);
    		$admin = $this->userRepository->findByGroup($adminGroup);
    		$this->view->assign('admin', $admin);    
    		
    		$client = $this->userRepository->findByGroup($userGroup);
    		$this->view->assign('client', $client);        				
    	} else {
    		$this->flashMessageService('tx_pimentrougetickets.flash.please_login','tx_pimentrougetickets.flash.status','ERROR' );
    		$this->redirect('','',null,array(), '1');
    	}        
    }
    
    /**
     * Set TypeConverter option for image upload
     * 
     * @return void
     */
    protected function initializeCreateAction(){
    	// Select box for create
    	$propertyMappingConfiguration = $this->arguments['newTicket']->getPropertyMappingConfiguration();
    	$propertyMappingConfiguration->allowProperties('admin');
    	
    	// Upload images
    	$this->setTypeConverterConfigurationForImageUpload('newTicket');
    	 
    	// Date Time
    	$propertyMappingConfiguration = $this->arguments['newTicket']->getPropertyMappingConfiguration();
    	$propertyMappingConfiguration->allowAllProperties();
    	$propertyMappingConfiguration->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
    
    	if (isset($this->arguments['newTicket'])) {
    		$this->arguments['newTicket']
    		->getPropertyMappingConfiguration()
    		->forProperty('createDate')
    		->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');        
    		//->setTypeConverterOption('TYPO3\FLOW3\Property\TypeConverter\DateTimeConverter', \TYPO3\FLOW3\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d');
    	}
    }      
      
    /**
     * action create
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket
     * @return void
     */
    public function createAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket)
    {
    	//\TYPO3\CMS\Core\Utility\DebugUtility::debug($_POST);
    	if($this->accessControllService->isAccessAllowed($user)) {
    		$userGroup = $this->settings['userGroup']; 
    		$this->view->assign('settings', $this->settings);
    		$this->view->assign('user', $user);
      		$this->view->assign('admin', $admin);
    		$this->view->assign('client', $client);
    		$this->ticketRepository->add($newTicket);
    		$this->persistenceManager->persistAll();    			
    		//$newTicket->setUser($user); 
    		$this->flashMessageService('tx_pimentrougetickets.flash.ticket_added','tx_pimentrougetickets.flash.status','OK' );
  			
    		// Get usergroup for select mail method. If usergorup = 1, send like front end users  
    		$group = $user->getUsergroup();    		   		
    		// Get notice for sen email to customer.
    		$notice = $newTicket->getNotice();
    		// Get private status
    		$notice = $newTicket->getPrivate();
    		
    		if ($group == $userGroup) {
    			// Set user if fe-user create ticket. We set user only usergroup = 1. 
     			
    			// Send mail for usergroup = 1
    			/*$template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message */
    			$this->div->sendEmail(
    				'MailAdminNotificationCreate',
    				// Mail to admin
    				$this->settings['toEmail'],
    				// Copy mail to client which create ticket
    				$user->getEmail(),
    				// From
    				$this->settings['fromEmail'],	    				
    				// Subject
    				$this->settings['createTicketSubject'],
    				// Message
    				array('ticket' => $newTicket, 'user' => $user),
    				$message
  				); 
    			$this->redirect('','',null,array(), '10');
    			
    		} else {    	    			
    			if($notice == 1) {    	
    				// Send emal wiht notice to customer
    				$this->div->sendEmail(
    						'MailCustomerNotificationCreate',
    						//$this->settings['toEmail'],
    						$newTicket->getAdmin()->getEmail(),
    						//$user->getEmail(),
    						$newTicket->getUser()->getEmail(),
    						$this->settings['fromEmail'],
    						// Subject
    						$this->settings['createTicketSubject'],
    						// Message
    						array('ticket' => $newTicket, 'user' => $user),
    						$message
    						);
    				} else {
    					// Send emal wihtout notice to customer
    					$this->div->sendEmail(
    							'MailCustomerNotificationCreate',
    							$newTicket->getAdmin()->getEmail(),
    							$this->settings['fromEmail'],
    							$this->settings['fromEmail'],
    							// Subject
    							$this->settings['createTicketSubject'],
    							// Message
    							array('ticket' => $newTicket, 'user' => $user),
    							$message
    							);    					
    				}
    				$this->redirect('','',null,array(), '27');
    			}
    					
    		//$this->redirect('ticketsList','User',null,array(), '10');		
    		
    	} else {
    		//$this->addFlashMessage(LocalizationUtility::translate('tx_pimentrougetickets.flash.please_login', 'Pimentrougetickets'), '' ,\TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
    		$this->flashMessageService('tx_pimentrougetickets.flash.please_login','tx_pimentrougetickets.flash.status','ERROR' );
    		$this->redirect('','',null,array(), '1');    
    	}
    }
    
    
    /**
     * action create by admin
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket
     * @return void
     */
    public function createByAdminAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket)
    {
    	if($this->accessControllService->isAccessAllowed($user)) {  
    		\TYPO3\CMS\Core\Utility\DebugUtility::debug($_REQUEST); 
    		$this->view->assign('settings', $this->settings);
    		$this->view->assign('user', $user);
    		$newTicket->setUser($user);
    		//$this->ticketRepository->add($newTicket);
    		$this->persistenceManager->persistAll();
    		$this->flashMessageService('tx_pimentrougetickets.flash.ticket_added','tx_pimentrougetickets.flash.status','OK' );
    		
    		// Send mail
    		/*$template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message */
    		$this->div->sendEmail(
    				'MailAdminNotificationCreate',
    				//$this->settings['toEmail'],
    				$ticket->getAdmin()->getEmail(),
    				
    				//$user->getEmail(),
    				$ticket->getUser()->getEmail(),
    				
    				$this->settings['fromEmail'],	    				
    				
    				// Subject
    				$this->settings['createTicketSubject'],
    				
    				// Message
    				array('ticket' => $newTicket, 'user' => $user),
    				$message
  			);    		  				
    		$this->redirect('ticketsList','User',null,array(), '10');
    		
    	} else {
    		//$this->addFlashMessage(LocalizationUtility::translate('tx_pimentrougetickets.flash.please_login', 'Pimentrougetickets'), '' ,\TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
    		$this->flashMessageService('tx_pimentrougetickets.flash.please_login','tx_pimentrougetickets.flash.status','ERROR' );
    		$this->redirect('','',null,array(), '1');    
    	}
    }    
    
    
    /**
     * action edit
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @ignorevalidation $ticket
     * @return void
     */
    public function editAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)		
    {
    	//$this->view->assign('adminUserGroup', $this->frontendUserGroupRepository->findByUid(2));
    	// User access
/*    	
    	if($this->accessControllService->isAccessAllowed($user)) {
    		$adminGroup = $this->settings['adminGroup'];
    		$admin = $this->userRepository->findByGroup($adminGroup);
    		$this->view->assign('admin', $admin);
    			
    		$newAnswer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
    		$this->view->assign('newAnswer', $newAnswer);
    	
    		$this->view->assign('user', $user);
    		$this->view->assign('ticket', $ticket);
    		
    		$this->view->assign('category', $this->categoryRepository->findAll());
    		$this->view->assign('priority', $this->priorityRepository->findAll());    	
    		$this->view->assign('status', $this->statusRepository->findAll());    		
    		
    	} else {
    		$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_pimentrougetickets.please_login', 'Pimentrougetickets'), '' ,\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
    		$this->redirect('','',null,array(), '1');    		
    	}
    	*/
    	
    	$adminGroup = $this->settings['adminGroup'];
    	$userGroup = $this->settings['userGroup'];
    	$notice = $ticket->getNotice();
    	
    	$admin = $this->userRepository->findByGroup($adminGroup);
    	$this->view->assign('admin', $admin);
    	 
    	$client = $this->userRepository->findByGroup($userGroup);
    	$this->view->assign('client', $client);
    	
    	$newAnswer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
    	$this->view->assign('newAnswer', $newAnswer);
    	 
    	$this->view->assign('user', $user);
    	$this->view->assign('ticket', $ticket);
    	
    	$this->view->assign('category', $this->categoryRepository->findAll());
    	$this->view->assign('priority', $this->priorityRepository->findAll());
    	$this->view->assign('status', $this->statusRepository->findAll());
    }  
    
    /**
     * Set TypeConverter option for image upload
     */
    public function initializeUpdateAction() {
    	$this->setTypeConverterConfigurationForImageUpload('ticket');
    	
    	$propertyMappingConfiguration = $this->arguments['ticket']->getPropertyMappingConfiguration();
    	$propertyMappingConfiguration->allowProperties('admin');
    }    
    

    /**
     * action update
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function updateAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {  	
    	//\TYPO3\CMS\Core\Utility\DebugUtility::debug($_REQUEST);
    	$this->view->assign('settings', $this->settings);
    	$this->view->assign('user', $user);
    	$this->ticketRepository->update($ticket);
    	$this->persistenceManager->persistAll();
    	$notice = $ticket->getNotice();	
    	$this->flashMessageService('tx_pimentrougetickets.flash.ticket_updated','tx_pimentrougetickets.flash.status','OK' );
    	
    	if($notice == 1) {
    		// Send emal wiht notice to customer
    		/*$template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message */
    		$this->div->sendEmail(
    			'MailTicketNotificationUpdate',
    			// To email
    			$ticket->getAdmin()->getEmail(),
    			$ticket->getUser()->getEmail(),
    			$this->settings['fromEmail'],
    			// Subject
    			$this->settings['updateTicketSubject'],
    			// Message
    			array('ticket' => $ticket, 'user' => $user),
    			$message
    		);    		
    	} else {
    		$this->div->sendEmail(
    			'MailTicketNotificationUpdate',
    			// To email
    			$ticket->getAdmin()->getEmail(),
    			$this->settings['fromEmail'],
    			$this->settings['fromEmail'],
    			// Subject
    			$this->settings['updateTicketSubject'],
    			// Message
    			array('ticket' => $ticket, 'user' => $user),
    			$message
    		);    		
    	}
    	
    	$this->redirect('','',null,array(), '27');
    	
    	/*
    	if($this->accessControllService->isAccessAllowed($user)) {
  		    	
    	} else {
    		$this->flashMessageService('tx_pimentrougetickets.flash.please_login','tx_pimentrougetickets.flash.status','ERROR' );
    		$this->redirect('','',null,array(), '1');
    	}
    	*/
    }    
    
    
    /**
     * action delete
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function deleteAction(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {		    	
    	
    	$this->view->assign('settings', $this->settings);
    	$user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
    	$this->view->assign('user', $user);    	
    	
    	if($this->accessControllService->isAccessAllowed($user)) {  
    		$this->ticketRepository->remove($ticket);
    		$this->flashMessageService('tx_pimentrougetickets.flash.ticket_deleted','tx_pimentrougetickets.flash.status','OK' );
    		 
    		// Send mail
    		/*$template, $receiver, $receiverCc, $sender, $subject, $variables = array(), $message */
    		$this->div->sendEmail(
    				'MailAdminNotificationDelete',
    				$this->settings['toEmail'],
    				$ticket->getUser()->getEmail(),
    				//$user->getEmail(),
    				$this->settings['fromEmail'],
    				// Subject
    				$this->settings['deleteTicketSubject'],
    				// Message
    				array('ticket' => $ticket, 'user' => $user),
    				$message
    				);
    		//$this->redirect('list','Ticket',null,array(), '27');
    		$this->redirect('','',null,array(), '27');   			   		
    	} else {
    		$this->flashMessageService('tx_pimentrougetickets.flash.please_login','tx_pimentrougetickets.flash.status','ERROR' );
    		$this->redirect('','',null,array(), '1');
    	} 
    	 	
    }
    
    
    /**
     * ask buton using in template
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket
     * @ignorevalidation $newTicket
     * @return void
     */
    public function ticketButtonAction(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $newTicket = NULL)
    {
        $user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
        $this->view->assign('user', $user);
        $this->view->assign('newTicket', $newTicket);
    }
    
    
    /**
     *
     */
    protected function setTypeConverterConfigurationForImageUpload($argumentName) {
    	$uploadConfiguration = array(
    			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
    			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
    	);
    	/** @var PropertyMappingConfiguration $newImageConfiguration */
    	$newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
    	$newExampleConfiguration->forProperty('image')
    	->setTypeConverterOptions(
    			'PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceConverter',
    			$uploadConfiguration
    			);
    	$newExampleConfiguration->forProperty('imageCollection.0')
    	->setTypeConverterOptions(
    			'PimentRouge\\Pimentrougetickets\\Property\\TypeConverter\\UploadedFileReferenceConverter',
    			$uploadConfiguration
    			);
    }    

    
    public function createDefaultStatus() {
    	$object->setStatus($this->settings['defaultStatus']);
    	return $object;
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