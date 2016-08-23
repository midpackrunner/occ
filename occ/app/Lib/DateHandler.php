<?php 

namespace App\Lib;

/**
 * Incomplete.  Google spreadsheets can use the proper format needed:
 * 
 *                 YYYY-MM-DD
 */
class DateHandler {

	var $format;
	var $curr_format;
	var $new_formatted_date;
	var $old_formatted_date;
	var $month;
	var $day;
	var $year;
	var $err_code = 0;

	public function __construct($date, $curr_format, $to_format='Y-m-d')
	{
		$this->old_formatted_date = $date;
		$this->curr_format = $curr_format;
		$this->format = $to_format;
		$this->err_code = $this->extract_date_fields();
		if ($this->err_code == 0) {
			$this->err_code = $this->formatter();
		}
	}

	private function formatter()
	{
		switch ($this->format) {
			case 'Y-m-d':
				$this->new_formatted_date = $this->year. '-' . 
											$this->month . '-' . 
											$this->day;
				break;
			
			default:
				return 13;
				break;
		}
		return 0;
	}

	private function extract_date_fields()
	{	
		$tmp_remainder_str;
		switch ($this->curr_format) {
			case 'm/d/Y':
				// single digit month
				if (substr($this->old_formatted_date, 1, 1) == '/')  {
					$this->month = '0' . substr($this->old_formatted_date, 0, 1);
					$tmp_remainder_str = substr($this->old_formatted_date, 2);
				} else {    // double digit month
					$this->month = substr($this->old_formatted_date, 0, 2);
					$tmp_remainder_str = substr($this->old_formatted_date, 3);
				}
				// single digit day
				if (substr($tmp_remainder_str, 1, 1) == '/')  {
					$this->day = '0' . substr($tmp_remainder_str, 0, 1);
					$tmp_remainder_str = substr($tmp_remainder_str, 2);
				} else {    // double digit day
					$this->day = substr($tmp_remainder_str, 0, 2);
					$tmp_remainder_str = substr($tmp_remainder_str, 3);
				}
				$this->year = $tmp_remainder_str;
				break;
			
			default:
				return 11;
				break;
		}

		return 0;
	}

	/**
	 * Returns the result of parsing a date field.
	 * Codes:
	 *         0: All is good 
	 *        13: Unknown new format
	 *        11. Unknown old format
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function result()
	{
		return $this->err_code;
	}

	public function get_formatted_date()
	{
		return $this->new_formatted_date;
	}


}