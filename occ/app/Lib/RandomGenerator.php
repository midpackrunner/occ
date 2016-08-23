<?php

namespace App\Lib;

use App\User;

/**
* Generates random values.
*/
class RandomGenerator
{
	
	function __construct()
	{
	}

	protected function make_seed()
	{
	  list($usec, $sec) = explode(' ', microtime());
	  return (float) $sec + ((float) $usec * 100000);
	}

	/**
	 * Generates a random string containing upper case chars
	 * and digits.  Checks the User table's user_id to ensure
	 * a unique value is generated  
	 *
	 * @param integer $num_of_letters  number of letters to generate
	 * @param integer $num_of_digits   number of digits to generate
	 *
	 * @return string  Random user id in the form of: 
	 * 						<numOfLetters><numOfDigits>
	 */
	public function get_random_user_id($num_of_letters, $num_of_digits)
	{
		
		while (true) 
		{
			$values = array();
			mt_srand($this->make_seed());

			for ($i=0; $i < $num_of_letters; $i++) { 
				// ascii 48-57 integers
				// 65-90 is char Upper case
				$rand = mt_rand(0, 25);
				array_push($values, chr($rand + 65));
			}

			for ($i=0; $i < $num_of_digits; $i++) { 
				$rand = mt_rand(0, 9);
				array_push($values, chr($rand + 48));
			}

			$temp = implode( '', $values); 
			$user = User::find($temp);
			if ($user == null) {
				return $temp; 
			}
			unset($values);
		}
	}
}
?>