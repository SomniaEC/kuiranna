<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Sequence;
use Doctrine\ORM\EntityManager;

class SequenceManager {
	private $em;
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 * Get the next number of the sequence given a seed string
	 *
	 * @param string $seed
	 *        	the seed of the sequence
	 * @param int $initialNumber
	 *        	a start value, where the index begins
	 *        	
	 */
	public function getNext($seed, $initialNumber = 1) {
		$this->em->getConnection ()->beginTransaction ();
		//try {

			$seq = $this->em->getRepository ( 'AppBundle:Sequence' )->findOneBy ( array ( 'seed' => $seed ) );
			if ($seq != null) {
				$currentNumber = $seq->getNumber();
			}
			if (!isset($currentNumber)) {
				$sequence = new Sequence ( $seed, $initialNumber . "" );
				$this->em->persist ( $sequence );
				$nextVal = $initialNumber;
			} else {
				$nextVal = $currentNumber[0][0] + 1;
				$query = $this->em->createQuery ( 'UPDATE AppBundle:Sequence s SET s.number=:number WHERE s.seed=:seed');
				$query->setParameters ( array (
						'seed' => $seed,
						'number' => $nextVal 
				) );
				$query->execute ();
			}
			$this->em->getConnection ()->commit ();
			return $nextVal;
		//} catch ( \Exception $e ) {
		//	$this->em->getConnection ()->rollback ();
		//}
		//return - 1;
	}
}