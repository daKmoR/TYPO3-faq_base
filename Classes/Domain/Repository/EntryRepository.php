<?php
namespace TYPO3\FaqBase\Domain\Repository;

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
class EntryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Find all FAQ objects by the given demand object
	 *
	 * @param \TYPO3\FaqBase\Domain\Model\Dto\Demand $demand
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findDemanded(\TYPO3\FaqBase\Domain\Model\Dto\Demand $demand) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->setOrderings($this->createOrdering());

		$constraints = $this->createConstraintsFromDemand($query, $demand);
		if (!empty($constraints)) {
			$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		return $query->execute();
	}

	/**
	 * Create the constraints which are used for the query
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param \TYPO3\FaqBase\Domain\Model\Dto\Demand $demand
	 * @return array
	 */
	protected function createConstraintsFromDemand(\TYPO3\CMS\Extbase\Persistence\QueryInterface $query, \TYPO3\FaqBase\Domain\Model\Dto\Demand $demand) {
		$constraints = array();

		// Startingpoint
		$startingpoint = $demand->getStartingpoint();
		if ((!empty($startingpoint))) {
			$pidList = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $startingpoint, TRUE);
			$constraints[] = $query->in('pid', $pidList);
		}

		// Categories
		$categories = $demand->getCategories();
		if ((!empty($categories))) {
			$categoryConstraints = array();
			$categories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $categories, TRUE);
			foreach ($categories as $category) {
					$categoryConstraints[] = $query->contains('category', $category);
			}

			$constraints = $query->logicalOr($categoryConstraints);
		}
		return $constraints;
	}

	/**
	 * Create the ordering
	 *
	 * @return array
	 */
	protected function createOrdering() {
		$orderings = array('sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);

		return $orderings;
	}

}

?>