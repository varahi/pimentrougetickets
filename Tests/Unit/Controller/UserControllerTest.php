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
 * Test case for class PimentRouge\Pimentrougetickets\Controller\UserController.
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class UserControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \PimentRouge\Pimentrougetickets\Controller\UserController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('PimentRouge\\Pimentrougetickets\\Controller\\UserController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllUsersFromRepositoryAndAssignsThemToView()
	{

		$allUsers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$userRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\UserRepository', array('findAll'), array(), '', FALSE);
		$userRepository->expects($this->once())->method('findAll')->will($this->returnValue($allUsers));
		$this->inject($this->subject, 'userRepository', $userRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('users', $allUsers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenUserToView()
	{
		$user = new \PimentRouge\Pimentrougetickets\Domain\Model\User();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('user', $user);

		$this->subject->showAction($user);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenUserToUserRepository()
	{
		$user = new \PimentRouge\Pimentrougetickets\Domain\Model\User();

		$userRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\UserRepository', array('add'), array(), '', FALSE);
		$userRepository->expects($this->once())->method('add')->with($user);
		$this->inject($this->subject, 'userRepository', $userRepository);

		$this->subject->createAction($user);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenUserToView()
	{
		$user = new \PimentRouge\Pimentrougetickets\Domain\Model\User();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('user', $user);

		$this->subject->editAction($user);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenUserInUserRepository()
	{
		$user = new \PimentRouge\Pimentrougetickets\Domain\Model\User();

		$userRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\UserRepository', array('update'), array(), '', FALSE);
		$userRepository->expects($this->once())->method('update')->with($user);
		$this->inject($this->subject, 'userRepository', $userRepository);

		$this->subject->updateAction($user);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenUserFromUserRepository()
	{
		$user = new \PimentRouge\Pimentrougetickets\Domain\Model\User();

		$userRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\UserRepository', array('remove'), array(), '', FALSE);
		$userRepository->expects($this->once())->method('remove')->with($user);
		$this->inject($this->subject, 'userRepository', $userRepository);

		$this->subject->deleteAction($user);
	}
}
