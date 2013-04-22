<?php
namespace TYPO3\FaqBase\Domain\Model;

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
 *
 *
 * @package faq_base
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category {

	/**
	 * @return mixed
	 */
	public function getFaqs() {
		$cleanedFaqs = array();
//		$faqs = \TYPO3\CMS\Core\Category\Collection\CategoryCollection::load($this->getUid(), TRUE, 'tx_faqbase_domain_model_entry');
		// @toDo: above function is buggy :/ fetch them manually

		// fetch with default language
		$where = 'AND sys_category.uid=' . intval($this->getUid()) . ' AND sys_category_record_mm.tablenames = "tx_faqbase_domain_model_entry" ' . ' AND tx_faqbase_domain_model_entry.sys_language_uid=0 ';
		$where .= $GLOBALS['TSFE']->sys_page->enableFields('tx_faqbase_domain_model_entry');

		$relatedRecords = array();
		$resource = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query(
			'tx_faqbase_domain_model_entry' . '.*',
			'sys_category',
			'sys_category_record_mm',
			'tx_faqbase_domain_model_entry',
			$where
		);

		if ($resource) {
			while ($record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resource)) {
				// overlay language record if needed
				if ($GLOBALS['TSFE']->sys_language_content !== 0) {
					$record = $GLOBALS['TSFE']->sys_page->getRecordOverlay('tx_faqbase_domain_model_entry',  $record, $GLOBALS['TSFE']->sys_language_content,  $GLOBALS['TSFE']->sys_language_contentOL);
				}
				$relatedRecords[] = $record;
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($resource);
		}

		return $relatedRecords;
	}

}

?>