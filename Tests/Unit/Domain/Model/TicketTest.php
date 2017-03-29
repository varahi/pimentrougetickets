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
 * Test case for class \PimentRouge\Pimentrougetickets\Domain\Model\Ticket.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class TicketTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \PimentRouge\Pimentrougetickets\Domain\Model\Ticket
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();
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
	public function getProjectReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getProject()
		);
	}

	/**
	 * @test
	 */
	public function setProjectForStringSetsProject()
	{
		$this->subject->setProject('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'project',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
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
	public function getCostReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getCost()
		);
	}

	/**
	 * @test
	 */
	public function setCostForStringSetsCost()
	{
		$this->subject->setCost('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cost',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForCategory()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForCategorySetsCategory()
	{
		$categoryFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\Category();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriorityReturnsInitialValueForPriority()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getPriority()
		);
	}

	/**
	 * @test
	 */
	public function setPriorityForPrioritySetsPriority()
	{
		$priorityFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\Priority();
		$this->subject->setPriority($priorityFixture);

		$this->assertAttributeEquals(
			$priorityFixture,
			'priority',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForStatus()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getStatus()
		);
	}

	/**
	 * @test
	 */
	public function setStatusForStatusSetsStatus()
	{
		$statusFixture = new \PimentRouge\Pimentrougetickets\Domain\Model\Status();
		$this->subject->setStatus($statusFixture);

		$this->assertAttributeEquals(
			$statusFixture,
			'status',
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
