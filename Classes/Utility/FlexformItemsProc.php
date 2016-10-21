<?php

namespace CIC\Cicslide\Utility;

/***************************************************************
 *  Copyright notice
 *  (c) 2011 Zach Davis <zach@castironcoding.com>, CIC
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
 * @package cicslide
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later

 */
class FlexformItemsProc {

    /**
     * @param $params
     * @param $pObj
     */
	public function processSlidesItemArray(&$params, $pObj) {
		$items = $params['items'];
        $slideTypeUid = $params['row']['settings.slideType'][0];
		if($slideTypeUid && is_array($items) && count($items) > 0) {
			// get all item UIDs
			$itemUids = array();
			foreach($items as $item) {
				$itemUids[$item[1]] = intval($item[1]);
			}

			// get allowed slides based on type
			$select = 'S.uid';
            $table = 'tx_cicslide_domain_model_slide S JOIN tx_cicslide_domain_model_type T on S.slidetype = T.uid AND T.uid = ' . intval($slideTypeUid);
            $where = 'S.hidden=0 AND S.deleted=0 AND S.uid IN (' . implode(',', $itemUids) . ') ' .
                'OR (S.t3ver_oid IN (' . implode(',', $itemUids) . ') AND S.t3ver_wsid=' . $GLOBALS['BE_USER']->workspace . ')';
            $qres = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select, $table, $where);
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($qres)) {
				$allowed[] = $row['uid'];
			}

			// reduce the items array
			foreach($params['items'] as $k => $item) {
				$itemUid = $item[1];
				if(!in_array($itemUid,$allowed)) {
					unset($params['items'][$k]);
				}
			}
		}
	}
}
