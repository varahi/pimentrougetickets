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
 * Test case for class PimentRouge\Pimentrougetickets\Controller\AnswerController.
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class AnswerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \PimentRouge\Pimentrougetickets\Controller\AnswerController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('PimentRouge\\Pimentrougetickets\\Controller\\AnswerController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllAnswersFromRepositoryAndAssignsThemToView()
	{

		$allAnswers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$answerRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\AnswerRepository', array('findAll'), array(), '', FALSE);
		$answerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allAnswers));
		$this->inject($this->subject, 'answerRepository', $answerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('answers', $allAnswers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenAnswerToView()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('answer', $answer);

		$this->subject->showAction($answer);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenAnswerToAnswerRepository()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();

		$answerRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\AnswerRepository', array('add'), array(), '', FALSE);
		$answerRepository->expects($this->once())->method('add')->with($answer);
		$this->inject($this->subject, 'answerRepository', $answerRepository);

		$this->subject->createAction($answer);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenAnswerToView()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('answer', $answer);

		$this->subject->editAction($answer);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenAnswerInAnswerRepository()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();

		$answerRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\AnswerRepository', array('update'), array(), '', FALSE);
		$answerRepository->expects($this->once())->method('update')->with($answer);
		$this->inject($this->subject, 'answerRepository', $answerRepository);

		$this->subject->updateAction($answer);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenAnswerFromAnswerRepository()
	{
		$answer = new \PimentRouge\Pimentrougetickets\Domain\Model\Answer();

		$answerRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\AnswerRepository', array('remove'), array(), '', FALSE);
		$answerRepository->expects($this->once())->method('remove')->with($answer);
		$this->inject($this->subject, 'answerRepository', $answerRepository);

		$this->subject->deleteAction($answer);
	}
}
