<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Hash
{
	protected $ci, $generator;

	public function __construct()
	{
        $this->ci =& get_instance();
        $factory = new RandomLib\Factory;
        $this->generator = $factory->getMediumStrengthGenerator();
	}

	public function createUUID()
	{
		return Uuid::uuid4()->toString();
	}

	function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
	}

	function generateToken(){
		return $this->generator->generateString(64);
	}
}

/* End of file Hash.php */
/* Location: ./application/libraries/Hash.php */
