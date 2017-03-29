<?php
namespace PimentRouge\Pimentrougetickets\Domain\Repository;

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
 * The repository for Tickets
 */
class TicketRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );
    
   public function findByAdminAndOpened($user,$opened) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('admin', $user),
    					$query->equals('status', $opened)
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }    
    
    public function findOpened($opened) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('status', $opened)
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }
    
    public function findClosed($closed) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('status', $closed),
    					$query->equals('private', '0')
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }    
    
    public function findByUidAndOpened(
    		PimentRouge\Pimentrougetickets\Domain\Model\User $user,
    		PimentRouge\Pimentrougetickets\Domain\Model\Ticket $opened){
    			$query = $this->createQuery();
    			$query->matching(
    					$query->logicalAnd(
    							$query->equals('user', $user),
    							$query->equals('status', $opened)
    							)
    					)
    					->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    					->execute();
    }      
    
   public function findOpenedAndPrivate($opened) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('private', '1'),
    					$query->equals('status', $opened)
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }
    
    public function findClosedAndPrivate($closed) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('private', '1'),
    					$query->equals('status', $closed)
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }  
    
    public function findByAdminAndPrivateAndOpen($user, $opened) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('admin', $user),
    					$query->equals('status', $opened),
    					$query->equals('private', '1')
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }
    
    public function findByAdminAndPrivateAndClosed($user, $closed) {
    	$query = $this->createQuery();
    	return $query->matching(
    			$query->logicalAnd(
    					$query->equals('admin', $user),
    					$query->equals('status', $closed),
    					$query->equals('private', '1')
    					)
    			)
    			->setOrderings(array('crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
    			->execute();
    }    

}