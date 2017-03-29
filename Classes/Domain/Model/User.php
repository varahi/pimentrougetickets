<?php
namespace PimentRouge\Pimentrougetickets\Domain\Model;

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

/**
 * User
 */
class User extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * username
     *
     * @var string
     */
    protected $username = '';

    /**
     * fullname
     *
     * @var string
     */
    protected $fullname = '';    
    
    /**
     * usergroup
     *
     * @var string
     */
    protected $usergroup = '';    
    
    /**
     * email
     *
     * @var string
     */
    protected $email = '';
    
    /**
     * firstName
     *
     * @var string
     */
    protected $firstName = '';
    
    /**
     * lastName
     *
     * @var string
     */
    protected $lastName = '';
    
    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;
    
    /**
     * ticket
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket>
     * @cascade remove
     * @lazy
     */
    protected $ticket = null;
    
    /**
     * delegated ticket
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket>
     * @cascade remove
     * @lazy
     */
    protected $delegatedTicket = null;    
    
    /**
     * answer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Answer>
     * @cascade remove
     * @lazy
     */
    protected $answer = null;
    
    /**
     * message
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Message>
     * @cascade remove
     * @lazy
     */
    protected $message = null;
    
    /**
     * site
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Site>
     * @cascade remove
     * @lazy
     */
    protected $site = null;    
    
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->ticket = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->answer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->message = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->site = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }  
    
    /**
     * Returns the username
     *
     * @return string $fullname
     */
    public function getFullname()
    {
    	return ($this->getFirstname()." ".$this->getLastname());
    }    
    
    /**
     * Returns the username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Sets the username
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    
    /**
     * Returns the usergroup
     *
     * @return string $usergroup
     */
    public function getUsergroup()
    {
        return $this->usergroup;
    }    
    
    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns the firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * Returns the lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }
    
    /**
     * Adds a Ticket
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function addTicket(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {
        $this->ticket->attach($ticket);
    }
    
    /**
     * Removes a Ticket
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticketToRemove The Ticket to be removed
     * @return void
     */
    public function removeTicket(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticketToRemove)
    {
        $this->ticket->detach($ticketToRemove);
    }
    
    /**
     * Returns the ticket
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket> $ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
    
    /**
     * Sets the ticket
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket> $ticket
     * @return void
     */
    public function setTicket(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $ticket)
    {
        $this->ticket = $ticket;
    }   
    
    /* Delegated ticket */
    /**
     * Adds a Delegated Ticket
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $delegatedTicket
     * @return void
     */
    public function addDelegatedTicket(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $delegatedTicket)
    {
    	$this->delegatedTicket->attach($delegatedTicket);
    }
    
    /**
     * Removes a Delegated Ticket
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $delegatedTicketToRemove The Ticket to be removed
     * @return void
     */
    public function removeDelegatedTicket(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $delegatedTicketToRemove)
    {
    	$this->delegatedTicket->detach($delegatedTicketToRemove);
    }
    
    /**
     * Returns the delegated ticket
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket> $delegatedTicket
     */
    public function getDelegatedTicket()
    {
    	return $this->delegatedTicket;
    }
    
    /**
     * Sets the delegated ticket
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket> $delegatedTicket
     * @return void
     */
    public function setDelegatedTicket(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $delegatedTicket)
    {
    	$this->delegatedTicket = $delegatedTicket;
    }   
    
    
    /**
     * Adds a Answer
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer
     * @return void
     */
    public function addAnswer(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answer)
    {
        $this->answer->attach($answer);
    }
    
    /**
     * Removes a Answer
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Answer $answerToRemove The Answer to be removed
     * @return void
     */
    public function removeAnswer(\PimentRouge\Pimentrougetickets\Domain\Model\Answer $answerToRemove)
    {
        $this->answer->detach($answerToRemove);
    }
    
    /**
     * Returns the answer
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Answer> $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    
    /**
     * Sets the answer
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Answer> $answer
     * @return void
     */
    public function setAnswer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $answer)
    {
        $this->answer = $answer;
    }
    
    /**
     * Adds a Message
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Message $message
     * @return void
     */
    public function addMessage(\PimentRouge\Pimentrougetickets\Domain\Model\Message $message)
    {
        $this->message->attach($message);
    }
    
    /**
     * Removes a Message
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Message $messageToRemove The Message to be removed
     * @return void
     */
    public function removeMessage(\PimentRouge\Pimentrougetickets\Domain\Model\Message $messageToRemove)
    {
        $this->message->detach($messageToRemove);
    }
    
    /**
     * Returns the message
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Message> $message
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Sets the message
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Message> $message
     * @return void
     */
    public function setMessage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $message)
    {
        $this->message = $message;
    }
    
    /**
     * Adds a Site
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Site $site
     * @return void
     */
    public function addSite(\PimentRouge\Pimentrougetickets\Domain\Model\Site $site)
    {
    	$this->site->attach($site);
    }
    
    /**
     * Removes a Site
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Site $siteToRemove The Site to be removed
     * @return void
     */
    public function removeSite(\PimentRouge\Pimentrougetickets\Domain\Model\Site $siteToRemove)
    {
    	$this->site->detach($siteToRemove);
    }
    
    /**
     * Returns the site
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Site> $site
     */
    public function getSite()
    {
    	return $this->site;
    }
    
    /**
     * Sets the site
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Site> $site
     * @return void
     */
    public function setSite(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $site)
    {
    	$this->site = $site;
    }    

}