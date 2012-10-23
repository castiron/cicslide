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
	 * @var Tx_Cicslide_Domain_Repository_TypeRepository
	 */
	protected $slideTypeRepository;

	/**
	 * inject the slideTypeRepository
	 *
	 * @param Tx_Cicslide_Domain_Repository_TypeRepository slideTypeRepository
	 * @return void
	 */
	public function injectSlideTypeRepository(Tx_Cicslide_Domain_Repository_TypeRepository $slideTypeRepository) {
		$this->slideTypeRepository = $slideTypeRepository;
	}

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
	 * Shows the slideshow
	 */
	public function showAction() {
		// if necessary, switch view based on slide type.
		if($this->settings['slideType']) {
			$slideType = $this->slideTypeRepository->findByUid($this->settings['slideType']);
			if ($slideType->getViewname()) {
				$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
				$path = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']).'/Slide/'.ucfirst($slideType->getViewname()).'.html';
				if(file_exists($path)) {
					$this->view->setTemplatePathAndFilename($path);
				} else {
					// TODO: Consider throwing an exception here. This would happen if a user set a view on a type but the file didn't exist.
				}
			}
		}

		// Get the slide uids.
		$slideUids = t3lib_div::trimExplode(',',$this->settings['slides']);

		// Fetch from the repository.
		$slides = $this->slideRepository->findByUids($slideUids);

		// Randomize now if appropriate.  Doing this here allows for chunked randomization
		if($this->settings['randomize']) {
			$slides = $this->randomizeSlides(
				$slides,
				$this->settings['randomizeBatchSize'] ? $this->settings['randomizeBatchSize'] : 1
			);
		}

		// Send the slides to the view.
		$this->view->assign('slides', $slides);
	}

	/**
	 * Randomizes slide order, preserving existing
	 * ordering within chunks of $batchSize
	 *
	 * @param $slides
	 * @param $batchSize
	 * @return array
	 */
	protected function randomizeSlides($slides,$batchSize) {
		$sortedSlides = array();
		$batches = array();
		$i = 1;
		$j = 0;

		// Get the slides into batches
		foreach($slides as $slide) {
			$batches[$j][] = $slide;
			if(!($i % $batchSize)) {
				$j++;
			}
			$i++;
		}

		// Shuffle the set of batches
		shuffle($batches);

		// Return the shuffled set of slides
		foreach($batches as $batch) {
			foreach($batch as $slide) {
				$sortedSlides[] = $slide;
			}
		}
		return $sortedSlides;
	}
}
?>