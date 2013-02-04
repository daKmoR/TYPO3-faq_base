<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Faq',
	array(
		'Entry' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Entry' => '',
		
	)
);

?>