<?php

namespace CIC\Cicslide\Domain\Repository;

class SlideRepository extends \CIC\Cicbase\Persistence\Repository {
	/**
	 * @param $uids a string
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage result
	 */
	public function findByUids($uids) {
		$query = $this->createQuery();
 		$query->matching($query->in('uid', $uids));
		$queryResult = $query->execute();
		return $this->orderResultsByUids($queryResult,$uids);
	}
}
?>