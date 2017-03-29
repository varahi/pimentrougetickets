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
 * Test case for class PimentRouge\Pimentrougetickets\Controller\PriorityController.
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class PriorityControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \PimentRouge\Pimentrougetickets\Controller\PriorityController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('PimentRouge\\Pimentrougetickets\\Controller\\PriorityController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllPrioritiesFromRepositoryAndAssignsThemToView()
	{

		$allPriorities = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$priorityRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\PriorityRepository', array('findAll'), array(), '', FALSE);
		$priorityRepository->expects($this->once())->method('findAll')->will($this->returnValue($allPriorities));
		$this->inject($this->subject, 'priorityRepository', $priorityRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('priorities', $allPriorities);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
