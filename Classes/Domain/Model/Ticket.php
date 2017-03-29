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
 * Ticket
 */
class Ticket extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	
	/**
	 * tstamp
	 *
	 * @var int
	 */
	protected $tstamp = NULL;	
	
	/**
	 * createDate
	 *
	 * @var \DateTime
	 */
	protected $createDate = NULL;
	
	/**
	 * closeDate
	 *
	 * @var \DateTime
	 */
	protected $closeDate = NULL;

    /**
     * title
     * @validate NotEmpty
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * project
     *
     * @var string
     */
    protected $project = '';
    
    /**
     * description
     *
     * @var string
     */
    protected $description = '';
    
    /**
     * file
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $file = null;
    
    /**
     * cost
     *
     * @var string
     */
    protected $cost = '';
    
    /**
     * category
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\Category
     * @lazy
     */
    protected $category = null;
    
    /**
     * priority
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\Priority
     */
    protected $priority = null;
    
    /**
     * status
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\Status
     * @lazy
     */
    protected $status;
    
    /**
     * user
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $user = null;
    
    /**
     * admin
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $admin = null;
    
    /**
     * client
     *
     * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
     */
    protected $client = null;    
    
    /**
     * answer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PimentRouge\Pimentrougetickets\Domain\Model\Answer>
     * @cascade remove
     */
    protected $answer = null;
    
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
     * notice
     *
     * @var boolean
     */
    protected $notice = FALSE; 
    
    /**
     * private
     *
     * @var boolean
     */
    protected $private = FALSE;    
    
    
    /**
     * __construct
     */
    public function __construct()
    {
    		$this->createDate = new \DateTime();
    		//$this->imageCollection = new ObjectStorage();
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
        $this->answer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the project
     *
     * @return string $project
     */
    public function getProject()
    {
        return $this->project;
    }
    
    /**
     * Sets the project
     *
     * @param string $project
     * @return void
     */
    public function setProject($project)
    {
        $this->project = $project;
    }
    
    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Returns the cost
     *
     * @return string $cost
     */
    public function getCost()
    {
        return $this->cost;
    }
    
    /**
     * Sets the cost
     *
     * @param string $cost
     * @return void
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }
    
    /**
     * Returns the category
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Sets the category
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Category $category
     * @return void
     */
    public function setCategory(\PimentRouge\Pimentrougetickets\Domain\Model\Category $category)
    {
        $this->category = $category;
    }
    
    /**
     * Returns the priority
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\Priority $priority
     */
    public function getPriority()
    {
        return $this->priority;
    }
    
    /**
     * Sets the priority
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Priority $priority
     * @return void
     */
    public function setPriority(\PimentRouge\Pimentrougetickets\Domain\Model\Priority $priority)
    {
        $this->priority = $priority;
    }
    
    /**
     * Returns the status
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\Status $status
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Sets the status
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\Status $status
     * @return void
     */
    public function setStatus(\PimentRouge\Pimentrougetickets\Domain\Model\Status $status)
    {
        $this->status = $status;
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
     * Returns the admin
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\User $admin
     */
    public function getAdmin()
    {
    	return $this->admin;
    }
    
    /**
     * Sets the admin
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $admin
     * @return void
     */
    public function setAdmin(\PimentRouge\Pimentrougetickets\Domain\Model\User $admin)
    {
    	$this->admin = $admin;
    }
    
    
    /**
     * Returns the client
     *
     * @return \PimentRouge\Pimentrougetickets\Domain\Model\User $client
     */
    public function getClient()
    {
    	return $this->client;
    }
    
    /**
     * Sets the client
     *
     * @param \PimentRouge\Pimentrougetickets\Domain\Model\User $client
     * @return void
     */
    public function setClient(\PimentRouge\Pimentrougetickets\Domain\Model\User $client)
    {
    	$this->client = $client;
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
    

    /**
     * Returns the createDate
     *
     * @return \DateTime $createDate
     */
    public function getCreateDate() {
    	return $this->createDate;
    }
    
    /**
     * Sets the createDate
     *
     * @param \DateTime $createDate
     * @return void
     */
    public function setCreateDate(\DateTime $createDate) {
    	$this->createDate = $createDate;
    }
    
    /**
     * Returns the closeDate
     *
     * @return \DateTime $closeDate
     */
    public function getCloseDate() {
    	return $this->closeDate;
    }
    
    /**
     * Sets the closeDate
     *
     * @param \DateTime $closeDate
     * @return void
     */
    public function setCloseDate(\DateTime $closeDate) {
    	$this->closeDate = $closeDate;
    }  
    
    /**
     * Returns the tstamp
     *
     * @return int
     */
    public function getTstamp() {
    	return $this->tstamp;
    }  
    
    /**
     * Returns the number of comments
     *
     * @return integer The number of comments
     */
    public function getNumberOfAnswers() {
    	return count($this->answer);
    }    
    
    /**
     * Returns the notice
     *
     * @return boolean $notice
     */
    public function getNotice() {
    	return $this->notice;
    }
    
    /**
     * Sets the notice
     *
     * @param boolean $notice
     * @return void
     */
    public function setNotice($notice) {
    	$this->notice = $notice;
    }
    
    /**
     * Returns the boolean state of notice
     *
     * @return boolean
     */
    public function isNotice() {
    	return $this->notice;
    }  
 
    /**
     * Returns the private
     *
     * @return boolean $private
     */
    public function getPrivate() {
    	return $this->private;
    }
    
    /**
     * Sets the private
     *
     * @param boolean $private
     * @return void
     */
    public function setPrivate($private) {
    	$this->private = $private;
    }
    
    /**
     * Returns the boolean state of private
     *
     * @return boolean
     */
    public function isPrivate() {
    	return $this->private;
    }    

}