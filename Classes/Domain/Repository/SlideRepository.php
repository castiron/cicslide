<?php

class Tx_Cicslide_Domain_Repository_SlideRepository extends Tx_Cicbase_Persistence_Repository {
	/**
	 * @param string $uids
	 * @param boolean $respectSysLanguage whether to include slides from other languages in the results
	 * @return Tx_Extbase_Persistence_ObjectStorage result
	 */
	public function findByUids($uids, $respectSysLanguage = true) {
		$query = $this->createQuery();
 		$query->matching($query->in('uid', $uids));
		$query->getQuerySettings()->setRespectSysLanguage($respectSysLanguage);
		$queryResult = $query->execute();
		return $this->orderResultsByUids($queryResult,$uids);
	}
}
?>