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

use \TYPO3\CMS\Core\Messaging\AbstractMessage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * UserController
 */
class UserController extends ActionController
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
    protected $accessControllService = null;
    
    /**
     * ticketRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\TicketRepository
     * @inject
     */
    protected $ticketRepository = NULL;    
    
    /**
     * userRepository
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = NULL;
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
    }
    
    /**
     * action profile
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function profileAction()
    {
        $user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
        $this->view->assign('user', $user);
    }
    
    /**
     * action tickets list
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function ticketsListAction()
    { 	    	
    	$opened = $this->settings['defaultTicketStatus'];
        $user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
        $this->view->assign('user', $user);      
    } 
    
    /**
     * action admin tickets list
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function adminTicketsListAction()
    {
    	
    	$this->view->assign('settings', $this->settings);
    	$showClosedTickets = $this->settings['showClosedTickets'];
    	$opened = $this->settings['defaultTicketStatus'];
    	$adminGroup = $this->settings['adminGroup'];
    	$users = $this->userRepository->findByGroup($adminGroup);
    	$this->view->assign('users', $users);
    	
	/*
	   	if ($showClosedTickets == 1) {
   		
    	} else {
  		
    	}
    */	
    }    
    
    /**
     * action tickets archive
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function archiveListAction()
    {
        $user = $this->userRepository->findByUid(intval($GLOBALS['TSFE']->fe_user->user['uid']));
        $this->view->assign('user', $user);
    }
    
    /**
     * action show
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function showAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        
    }
    
    /**
     * action create
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $newUser
     * @return void
     */
    public function createAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }
    
    /**
     * action update
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function updateAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->userRepository->update($user);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(\PimentRouge\Pimentrougetickets\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }

}