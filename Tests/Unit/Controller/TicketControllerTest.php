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
 * Test case for class PimentRouge\Pimentrougetickets\Controller\TicketController.
 *
 * @author Dmitrii Vasilev <dmitry@typo3.ru.net>
 */
class TicketControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \PimentRouge\Pimentrougetickets\Controller\TicketController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('PimentRouge\\Pimentrougetickets\\Controller\\TicketController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTicketsFromRepositoryAndAssignsThemToView()
	{

		$allTickets = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$ticketRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\TicketRepository', array('findAll'), array(), '', FALSE);
		$ticketRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTickets));
		$this->inject($this->subject, 'ticketRepository', $ticketRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('tickets', $allTickets);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTicketToView()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('ticket', $ticket);

		$this->subject->showAction($ticket);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTicketToTicketRepository()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();

		$ticketRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\TicketRepository', array('add'), array(), '', FALSE);
		$ticketRepository->expects($this->once())->method('add')->with($ticket);
		$this->inject($this->subject, 'ticketRepository', $ticketRepository);

		$this->subject->createAction($ticket);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTicketToView()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('ticket', $ticket);

		$this->subject->editAction($ticket);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTicketInTicketRepository()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();

		$ticketRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\TicketRepository', array('update'), array(), '', FALSE);
		$ticketRepository->expects($this->once())->method('update')->with($ticket);
		$this->inject($this->subject, 'ticketRepository', $ticketRepository);

		$this->subject->updateAction($ticket);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTicketFromTicketRepository()
	{
		$ticket = new \PimentRouge\Pimentrougetickets\Domain\Model\Ticket();

		$ticketRepository = $this->getMock('PimentRouge\\Pimentrougetickets\\Domain\\Repository\\TicketRepository', array('remove'), array(), '', FALSE);
		$ticketRepository->expects($this->once())->method('remove')->with($ticket);
		$this->inject($this->subject, 'ticketRepository', $ticketRepository);

		$this->subject->deleteAction($ticket);
	}
}
