<?php
namespace PimentRouge\Pimentrougetickets\Tests\Unit\Controller;
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
 * Test case for class PimentRouge\Pimentrougetickets\Controller\MessageController.
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class MessageControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \PimentRouge\Pimentrougetickets\Controller\MessageController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('PimentRouge\\Pimentrougetickets\\Controller\\MessageController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMessagesFromRepositoryAndAssignsThemToView()
	{

		$allMessages = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$messageRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\MessageRepository', array('findAll'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMessages));
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('messages', $allMessages);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMessageToView()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('message', $message);

		$this->subject->showAction($message);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMessageToMessageRepository()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();

		$messageRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\MessageRepository', array('add'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('add')->with($message);
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$this->subject->createAction($message);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMessageFromMessageRepository()
	{
		$message = new \PimentRouge\Pimentrougetickets\Domain\Model\Message();

		$messageRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\MessageRepository', array('remove'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('remove')->with($message);
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$this->subject->deleteAction($message);
	}
}
