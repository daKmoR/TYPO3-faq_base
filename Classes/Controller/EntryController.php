<?php
namespace TYPO3\FaqBase\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Thomas Allmer <thomas.allmer@moodley.at>, moodley brands identity
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
 * @package faq_base
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class EntryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\FaqBase\Domain\Repository\EntryRepository
	 * @inject
	 */
	protected $entryRepository;

	/**
	 * @var \TYPO3\FaqBase\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * @var integer
	 */
	protected $originalLanguage = false;

	/**
	 * Handles a request. The result output is returned by altering the given response.
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request The request object
	 * @param \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response The response, modified by this handler
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 * @return void
	 */
	public function processRequest(\TYPO3\CMS\Extbase\Mvc\RequestInterface $request, \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response) {
		parent::processRequest($request, $response);
		if ($this->originalLanguage !== false) {
			$GLOBALS['TSFE']->sys_language_content = $this->originalLanguage;
		}
	}

	/*
	 *
	 */
	public function initializeAction() {
		if ($this->settings['forceLanguageUid'] > 0) {
			$this->originalLanguage = $GLOBALS['TSFE']->sys_language_content;
			$GLOBALS['TSFE']->sys_language_content = $this->settings['forceLanguageUid'];
		}
	}

	/**
	 * @return void
	 */
	public function listAction() {
		$categories = array();
		$categoriesUid = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $this->settings['categories'], TRUE);
		foreach($categoriesUid as $categoryUid) {
			$categories[] = $this->categoryRepository->findByUid($categoryUid);
		}

		$this->view->assign('categories', $categories);
	}

}

?>