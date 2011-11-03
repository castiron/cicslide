<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Michael McManus <michael@castironcoding.com>, CIC
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
	 *
	 *
	 * @package cicslide
	 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
	 *
	 */
	class Tx_Cicslide_Controller_SlideController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Cicslide_Domain_Repository_SlideRepository
	 */
	protected $slideRepository;

	/**
	 * Dependency injection of the Digital Asset Repository
	 *
	 * @param Tx_Cicslide_Domain_Repository_SlideRepository $slideRepository
	 * @return void
	 */
	public function injectSlideRepository(Tx_Cicslide_Domain_Repository_SlideRepository $slideRepository) {
		$this->slideRepository = $slideRepository;
	}

	/**
	 * action show
	 *
	 * @param $slide
	 * @return void
	 */
	public function showAction() {
		
		// Get the slide uids.
		$slides = explode(',',$this->settings['slides']);

		// Fetch from the repository.
		$slides = $this->slideRepository->findAll();

		// Send the slides to the view.
		$this->view->assign('slides', $slides);
	}
}
?>