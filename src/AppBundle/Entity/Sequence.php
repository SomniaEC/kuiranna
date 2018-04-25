<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sequence")
 */
class Sequence {
	
	function __construct($key, $number) {
		$this->seed = $key;
		$this->number = $number;
	}
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=false)
	 * @ORM\Id
	 */
	private $seed;
	
	/**
	 * @ORM\Column(type="bigint")
	 */
	
	private $number;
	/**
	 * @return mixed
	 */
	public function getSeed() {
		return $this->seed;
	}

	/**
	 * @param mixed $seed
	 */
	public function setSeed($seed) {
		$this->seed = $seed;
	}

	/**
	 * @return mixed
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param mixed $number
	 */
	public function setNumber($number) {
		$this->number = $number;
	}
}
