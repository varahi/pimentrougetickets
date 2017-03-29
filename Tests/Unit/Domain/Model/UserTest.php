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
 * Test case for class \PimentRouge\Pimentrougetickets\Domain\Model\User.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class UserTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PimentRouge\Pimentrougetickets\Domain\Model\User
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PimentRouge\Pimentrougetickets\Domain\Model\User();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getUsernameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getUsername()
		);
	}

	/**
	 * @test
	 */
	public function setUsernameForStringSetsUsername()
	{
		$this->subject->setUsername('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'username',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail()
	{
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName()
	{
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName()
	{
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage()
	{
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
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

	/**
	 * @test
	 */
	public function getAnswerReturnsInitialValueForAnswer()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAnswer()
		);
	}

	/**
	 * @test
	 */
	public function setAnswerForObjectStorageContainingAnswerSetsAnswer()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
		$objectStorageHoldingExactlyOneAnswer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAnswer->attach($answer);
		$this->subject->setAnswer($objectStorageHoldingExactlyOneAnswer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAnswer,
			'answer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAnswerToObjectStorageHoldingAnswer()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
		$answerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$answerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answer', $answerObjectStorageMock);

		$this->subject->addAnswer($answer);
	}

	/**
	 * @test
	 */
	public function removeAnswerFromObjectStorageHoldingAnswer()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
		$answerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$answerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answer', $answerObjectStorageMock);

		$this->subject->removeAnswer($answer);

	}

	/**
	 * @test
	 */
	public function getMessageReturnsInitialValueForMessage()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getMessage()
		);
	}

	/**
	 * @test
	 */
	public function setMessageForObjectStorageContainingMessageSetsMessage()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();
		$objectStorageHoldingExactlyOneMessage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneMessage->attach($message);
		$this->subject->setMessage($objectStorageHoldingExactlyOneMessage);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneMessage,
			'message',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addMessageToObjectStorageHoldingMessage()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();
		$messageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$messageObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($message));
		$this->inject($this->subject, 'message', $messageObjectStorageMock);

		$this->subject->addMessage($message);
	}

	/**
	 * @test
	 */
	public function removeMessageFromObjectStorageHoldingMessage()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();
		$messageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$messageObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($message));
		$this->inject($this->subject, 'message', $messageObjectStorageMock);

		$this->subject->removeMessage($message);

	}
}
