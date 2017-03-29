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
 * Answer
 */
class Answer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	
	/**
	 * createDate
	 *
	 * @var int
	 */
	protected $crdate = NULL;	

    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * answer
     * @validate NotEmpty
     *
     * @var string
     */
    protected $answer = '';
    
    /**
     * file
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $file = null;
    
    /**
     * ticket
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\Ticket
     * @lazy
     */
    protected $ticket = null;
    
    /**
     * user
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     * @lazy
     */
    protected $user = null;
    
    /**
     * Image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;
    
    /**
     * Image
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $imageCollection;   
    
    
    /**
     * Returns the crdate
     *
     * @return int
     */
    public function getCrdate() {
    	return $this->crdate;
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
     * Returns the answer
     *
     * @return string $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    
    /**
     * Sets the answer
     *
     * @param string $answer
     * @return void
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
    
    /**
     * Returns the file
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Sets the file
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
     * @return void
     */
    public function setFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file)
    {
        $this->file = $file;
    }
    
    /**
     * Returns the ticket
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
    
    /**
     * Sets the ticket
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket
     * @return void
     */
    public function setTicket(\PimentRouge\Pimentrougetickets\Domain\Model\Ticket $ticket)
    {
        $this->ticket = $ticket;
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
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage() {
    	return $this->image;
    }
    
    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage($image) {
    	$this->image = $image;
    }
    
    
    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $imageCollection
     */
    public function setImageCollection($imageCollection) {
    	$this->imageCollection = $imageCollection;
    }
    
    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getImageCollection() {
    	return $this->imageCollection;
    }    

}