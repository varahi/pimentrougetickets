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
 * Message
 */
class Message extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * subject
     *
     * @var string
     */
    protected $subject = '';
    
    /**
     * message
     *
     * @var string
     */
    protected $message = '';
    
    /**
     * createDate
     *
     * @var string
     */
    protected $createDate = '';
    
    /**
     * user
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $user = null;
    
    /**
     * sender
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $sender = null;
    
    /**
     * recipient
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $recipient = null;
    
    /**
     * Returns the subject
     *
     * @return string $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Sets the subject
     *
     * @param string $subject
     * @return void
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    /**
     * Returns the message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Sets the message
     *
     * @param string $message
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Returns the createDate
     *
     * @return string $createDate
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }
    
    /**
     * Sets the createDate
     *
     * @param string $createDate
     * @return void
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }
    
    /**
     * Returns the user
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Sets the user
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $user
     * @return void
     */
    public function setUser(\PimentRouge\Pimentrougetickets\Domain\Model\User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Returns the sender
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\User $sender
     */
    public function getSender()
    {
        return $this->sender;
    }
    
    /**
     * Sets the sender
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $sender
     * @return void
     */
    public function setSender(\PimentRouge\Pimentrougetickets\Domain\Model\User $sender)
    {
        $this->sender = $sender;
    }
    
    /**
     * Returns the recipient
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\User $recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
    
    /**
     * Sets the recipient
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $recipient
     * @return void
     */
    public function setRecipient(\PimentRouge\Pimentrougetickets\Domain\Model\User $recipient)
    {
        $this->recipient = $recipient;
    }

}