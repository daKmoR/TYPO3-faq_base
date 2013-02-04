<?php
namespace TYPO3\FaqBase\Domain\Model\Dto;

	/***************************************************************
	 *  Copyright notice
	 *  (c) 2013 Georg Ringer <typo3@ringerge.org>
	 *  All rights reserved
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 * @package faq_base
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Demand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $categories;

	/**
	 * @var string
	 */
	protected $startingpoint;

	/**
	 * @param string $startingpoint
	 */
	public function setStartingpoint($startingpoint) {
		$this->startingpoint = $startingpoint;
	}

	/**
	 * @return string
	 */
	public function getStartingpoint() {
		return $this->startingpoint;
	}

	/**
	 * @param string $categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * @return string
	 */
	public function getCategories() {
		return $this->categories;
	}

}