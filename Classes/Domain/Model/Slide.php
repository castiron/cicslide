<?php

namespace CIC\Cicslide\Domain\Model;

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
class Slide extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The DAM Repository
	 * @var \CIC\Cicbase\Domain\Repository\DigitalAssetRepository
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
	 * Slide should open in a lightbox
	 *
	 * @var bool
	 */
	protected $isLightbox;

	/**
	 * Slide images
	 *
	 * @var string
	 */
	protected $images;

	/**
	 * HTML
	 *
	 * @var string
	 */
	protected $html;

	/**
	 * @var string
	 */
	protected $lightboxWidth;

	/**
	 * @var string
	 */
	protected $lightboxHeight;

	/**
	 * Class name
	 *
	 * @var string
	 */
	protected $addclass;

	protected $damIsEnabled = false;

	public function initializeObject() {
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		if(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('dam')) {
			$this->damIsEnabled = true;
			$this->damRepository = $this->objectManager->get('CIC\Cicbase\Domain\Repository\DigitalAssetRepository');
		}
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
	 * @return bool
	 */
	public function getIsLightbox() {
		return $this->isLightbox;
	}

	/**
	 * @param $isLightbox
	 */
	public function setIsLightbox($isLightbox) {
		$this->isLightbox = $isLightbox;
	}

	/**
	 * @param $lightboxHeight
	 */
	public function setLightboxHeight($lightboxHeight) {
		$this->lightboxHeight = $lightboxHeight;
	}

	/**
	 * @return string
	 */
	public function getLightboxHeight() {
		return $this->lightboxHeight;
	}

	/**
	 * @param $lightboxWidth
	 */
	public function setLightboxWidth($lightboxWidth) {
		$this->lightboxWidth = $lightboxWidth;
	}

	/**
	 * @return string
	 */
	public function getLightboxWidth() {
		return $this->lightboxWidth;
	}

	/**
	 * @return string
	 */
	public function getCustomLightboxSizeAttributes() {
		$out = '';
		if($this->isLightbox) {
			if ($this->lightboxWidth) {
				$out .= ' data-width="'.$this->lightboxWidth.'"';
			}
			if ($this->lightboxHeight) {
				$out .= ' data-height="'.$this->lightboxHeight.'"';
			}
		}
		return $out;
	}

	/**
	 * Sets the link
	 *
	 * @return void
	 */
	public function getDamImages() {
		return $this->damRepository->get('tx_cicslide_domain_model_slide', $this->_localizedUid, 'images');
	}

	public function getUploadsImages() {
		$imagePaths = explode(',',$this->images);
		$out = array();
		foreach($imagePaths as $path) {
			$o = $this->objectManager->create('CIC\Cicbase\Domain\Model\DigitalAsset');
			$o->setFileName($path);
			$o->setFilePath('uploads/tx_cicslide/');
			$out[] = $o;
		}
		return $out;
	}

	/**
	 * Getter for images
	 *
	 * @return array Collection of DAM objects.
	 */
	public function getImages() {
		if ($this->damIsEnabled) {
			return $this->getDamImages();
		} else {
			return $this->getUploadsImages();
		}
	}

	/**
	 * Getter for first image
	 *
	 * @return array first DAM object
	 */
	public function getFirstImage() {
		$images = $this->getImages();
		if(is_array($images)) {
			$out = $images[0];
		} else {
			$out = null;
		}
		return $out;
	}

	/**
	 * Returns the link
	 *
	 * @return string $html
	 */
	public function getHtml() {
		return $this->html;
	}

	/**
	 * Sets the html
	 *
	 * @param string $html
	 * @return void
	 */
	public function setHtml($html) {
		$this->html = $html;
	}


	/**
	 * Returns the addclass
	 *
	 * @return string $addclass
	 */
	public function getAddclass() {
		return $this->addclass;
	}

	/**
	 * Sets the addclass
	 *
	 * @param string $addclass
	 * @return void
	 */
	public function setAddclass($addclass) {
		$this->addclass = $addclass;
	}
}
?>