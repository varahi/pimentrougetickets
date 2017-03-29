<?php

namespace PimentRouge\Pimentrougetickets\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dmitrii Vasilev <dmitry@typo3.ru.net>, PimentRouge
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \PimentRouge\Pimentrougetickets\Domain\Model\Category.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class CategoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PimentRouge\Pimentrougetickets\Domain\Model\Category
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PimentRouge\Pimentrougetickets\Domain\Model\Category();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTicketReturnsInitialValueForTicket()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTicket()
		);
	}

	/**
	 * @test
	 */
	public function setTicketForObjectStorageContainingTicketSetsTicket()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
		$objectStorageHoldingExactlyOneTicket = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTicket->attach($ticket);
		$this->subject->setTicket($objectStorageHoldingExactlyOneTicket);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTicket,
			'ticket',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTicketToObjectStorageHoldingTicket()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
		$ticketObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$ticketObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($ticket));
		$this->inject($this->subject, 'ticket', $ticketObjectStorageMock);

		$this->subject->addTicket($ticket);
	}

	/**
	 * @test
	 */
	public function removeTicketFromObjectStorageHoldingTicket()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
		$ticketObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$ticketObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($ticket));
		$this->inject($this->subject, 'ticket', $ticketObjectStorageMock);

		$this->subject->removeTicket($ticket);

	}
}
