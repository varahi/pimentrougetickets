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
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * ticket
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Ticket>
     * @cascade remove
     * @lazy
     */
    protected $ticket = null;
    
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
    }
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

}