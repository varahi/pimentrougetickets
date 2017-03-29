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
 * Test case for class \PimentRouge\Pimentrougetickets\Domain\Model\Message.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class MessageTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PimentRouge\Pimentrougetickets\Domain\Model\Message
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getSubjectReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getSubject()
		);
	}

	/**
	 * @test
	 */
	public function setSubjectForStringSetsSubject()
	{
		$this->subject->setSubject('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subject',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMessageReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getMessage()
		);
	}

	/**
	 * @test
	 */
	public function setMessageForStringSetsMessage()
	{
		$this->subject->setMessage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'message',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCreateDateReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCreateDate()
		);
	}

	/**
	 * @test
	 */
	public function setCreateDateForStringSetsCreateDate()
	{
		$this->subject->setCreateDate('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'createDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForUser()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getUser()
		);
	}

	/**
	 * @test
	 */
	public function setUserForUserSetsUser()
	{
		$userFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\User();
		$this->subject->setUser($userFixture);

		$this->assertAttributeEquals(
			$userFixture,
			'user',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSenderReturnsInitialValueForUser()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getSender()
		);
	}

	/**
	 * @test
	 */
	public function setSenderForUserSetsSender()
	{
		$senderFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\User();
		$this->subject->setSender($senderFixture);

		$this->assertAttributeEquals(
			$senderFixture,
			'sender',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRecipientReturnsInitialValueForUser()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getRecipient()
		);
	}

	/**
	 * @test
	 */
	public function setRecipientForUserSetsRecipient()
	{
		$recipientFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\User();
		$this->subject->setRecipient($recipientFixture);

		$this->assertAttributeEquals(
			$recipientFixture,
			'recipient',
			$this->subject
		);
	}
}
