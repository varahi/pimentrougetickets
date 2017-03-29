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
 * Test case for class \PimentRouge\Pimentrougetickets\Domain\Model\Answer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class AnswerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PimentRouge\Pimentrougetickets\Domain\Model\Answer
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();
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
	public function getAnswerReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getAnswer()
		);
	}

	/**
	 * @test
	 */
	public function setAnswerForStringSetsAnswer()
	{
		$this->subject->setAnswer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFileReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getFile()
		);
	}

	/**
	 * @test
	 */
	public function setFileForFileReferenceSetsFile()
	{
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setFile($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'file',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTicketReturnsInitialValueForTicket()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getTicket()
		);
	}

	/**
	 * @test
	 */
	public function setTicketForTicketSetsTicket()
	{
		$ticketFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
		$this->subject->setTicket($ticketFixture);

		$this->assertAttributeEquals(
			$ticketFixture,
			'ticket',
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
	public function getImageReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);

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
		$imageFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\FileReference();
		$this->subject->setImage($imageFixture);

		$this->assertAttributeEquals(
			$imageFixture,
			'image',
			$this->subject
		);

		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}
}
