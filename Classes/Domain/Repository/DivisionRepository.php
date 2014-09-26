<?php
namespace Ecom\SzDownloadcenter\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Björn Christopher Bresser <bjoern.bresser@sunzinet.com>, sunzinet AG
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
 * @package SzDownloadcenter
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DivisionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);

	public function initializeObject() {
		 /** @var $defaultQuerySettings \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface */
		 $defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
		 // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

		 // don't add the pid constraint
		 $defaultQuerySettings->setRespectStoragePage(FALSE);
		 // don't add sys_language_uid constraint
		 $defaultQuerySettings->setRespectSysLanguage(TRUE);

		 $this->setDefaultQuerySettings($defaultQuerySettings);
	 }

	public function findAllByLang($languageId) {
		$query = $this ->createQuery();
		$query->setOrderings(array('title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);

		return $query->matching(
			$query->equals('sys_language_uid', $languageId)
		)->execute();
	}

}
?>