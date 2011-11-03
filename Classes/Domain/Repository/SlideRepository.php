<?php

class Tx_Cicslide_Domain_Repository_SlideRepository extends Tx_Extbase_Persistence_Repository {

	public function findByUids($uids) {
		$query = $this->createQuery();
 		$query->matching($query->in('uid', $uids));
		return $query->execute();
	}
	
}
?>