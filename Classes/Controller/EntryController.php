<?php
namespace TYPO3\FaqBase\Controller;

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
class EntryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * entryRepository
	 *
	 * @var \TYPO3\FaqBase\Domain\Repository\EntryRepository
	 * @inject
	 */
	protected $entryRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$demand = $this->createDemandObjectFromSettings($this->settings);

		$entries = $this->entryRepository->findDemanded($demand);
		$this->view->assign('entries', $entries);
	}

	/**
	 * Create the demand object which define which records will get shown
	 *
	 * @param array $settings
	 * @return \TYPO3\FaqBase\Domain\Model\Dto\Demand
	 */
	protected function createDemandObjectFromSettings($settings) {
		/* @var $demand \TYPO3\FaqBase\Domain\Model\Dto\Demand */
		$demand = $this->objectManager->get('TYPO3\\FaqBase\\Domain\\Model\\Dto\\Demand');

		$demand->setCategories($settings['categories']);
		$demand->setStartingpoint($settings['startingpoint']);

		return $demand;
	}

}

?>