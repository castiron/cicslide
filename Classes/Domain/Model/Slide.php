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
class Tx_Cicslide_Domain_Model_Slide extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The DAM Repository
	 * @var Tx_Cicservices_Domain_Repository_DigitalAssetRepository
	 */
	protected $damRepository;

	/**
	 * Slide title.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Slide description.
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Slide link
	 *
	 * @var string
	 */
	protected $link;


	/**
	 * Slide images
	 *
	 * @var array
	 */
	protected $images;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	public function initializeObject() {
		$objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->damRepository = $objectManager->get('Tx_Cicbase_Domain_Repository_DigitalAssetRepository');
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Sets the link
	 *
	 * @return void
	 */
	public function setImages() {
		$this->images = $this->damRepository->get('tx_cicslide_domain_model_slide',$this->uid,'images');
	}

	/**
	 * Getter for publications
	 *
	 * @return array Collection of DAM objects.
	 */
	public function getImages() {
		$this->checkImages();
		return $this->images;
	}

	/**
	 * Make sure images are retrieved.
	 * @return void
	 */
	public function checkImages() {
		if(!$this->images) $this->setImages();
	}

	/**
	 * Getter for publications
	 *
	 * @return array Collection of DAM objects.
	 */
	public function getFirstImage() {
		$this->checkImages();

		if($this->images) {
			$out = $this->images[0];
		} else {
			$out = null;
		}
		return $out;
	}

}
?>