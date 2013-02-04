<?php
namespace TYPO3\FaqBase\Domain\Model;

	/***************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2013 Georg Ringer <typo3@ringerge.org>
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
 * @package faq_base
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Entry extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Question
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $question;

	/**
	 * Answer
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $answer;

	/**
	 * category
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\Category
	 */
	protected $category;

	/**
	 * __construct
	 *
	 * @return Entry
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the question
	 *
	 * @return \string $question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Sets the question
	 *
	 * @param \string $question
	 * @return void
	 */
	public function setQuestion($question) {
		$this->question = $question;
	}

	/**
	 * Returns the answer
	 *
	 * @return \string $answer
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * Sets the answer
	 *
	 * @param \string $answer
	 * @return void
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
	}

	/**
	 * Adds a
	 *
	 * @param Tx_Extbase_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_Extbase_Domain_Model_Category $category) {
		$this->category->attach($category);
	}

	/**
	 * Removes a
	 *
	 * @param Tx_Extbase_Domain_Model_Category $categoryToRemove The  to be removed
	 * @return void
	 */
	public function removeCategory(Tx_Extbase_Domain_Model_Category $categoryToRemove) {
		$this->category->detach($categoryToRemove);
	}

	/**
	 * Returns the category
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Tx_Extbase_Domain_Model_Category> $category
	 * @return void
	 */
	public function setCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $category) {
		$this->category = $category;
	}

}
?>