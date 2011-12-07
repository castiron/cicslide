<?php

class Tx_Cicslide_Domain_Repository_SlideRepository extends Tx_Cicbase_Persistence_Repository {
	/**
	 * @param $uids a string
	 * @return Tx_Extbase_Persistence_ObjectStorage result
	 */
	public function findByUids($uids) {
		$query = $this->createQuery();
 		$query->matching($query->in('uid', $uids));
		$queryResult = $query->execute();
		return $this->orderResultsByUids($queryResult,$uids);
	}
}
?>