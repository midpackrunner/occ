<?php


namespace App\Lib;

use App\Classes;
use App\Pet;
use Carbon\Carbon;


/**
* 
*/
class RosterFileManager
{
	private $instructor_filter;
	private $session_filter;
	private $num_of_clm_hrs;
	private $file_name;
	private $path_to_file;
	private $roster;
	private $full_path;
	private $header;

	function __construct($instructor_filter, $session_filter, $num_of_clm_hrs)
	{
		$this->instructor_filter = $instructor_filter;
		$this->session_filter = $session_filter;
		$this->num_of_clm_hrs = $num_of_clm_hrs;
		$this->set_roster($this->instructor_filter, $session_filter, $num_of_clm_hrs);
		$this->file_name = 'Roster.csv';
		$this->path_to_file = config('app.temp_folder');
		$this->full_path = $this->path_to_file . $this->file_name;
		$this->header = $this->get_header();
	}


	/** Get roster based on filter **/
	protected function set_roster($instr_fltr, $sess_fltr, $num_of_clm_hrs)
	{
		$classes = Classes::upComing();
        if ($instr_fltr != 'none') {
        	$classes->hasInstructor($instr_fltr);
        }
        if ($sess_fltr != 'none') {
        	$classes->ofSession($sess_fltr, Carbon::today()->year);
        }
        $classes->numberOfClaimedHours($num_of_clm_hrs);
        $this->roster = $classes->get();
	}

	protected function get_header()
	{
		return '"Session",' . '"Class Title",' .  '"Begin Date",'.'"End Date",' . '"Day",' .
			   '"Instructor 1",' . '"Instructor 2",' . '"Owner",' . '"Pet Name",' . '"Breed",' .
			   "\"Claimed Hours\"," . 
			   '"Email","Phone Number 1","Phone Number 2"'."\n";
	}

	public function write_to_file()
	{	
		$delmtr = "\n";
		$session = null;
		$class_t = null;
		$begin_date = null;
		$end_date = null;
		$day = null;
		$instrctr_1 = null;
		$instrctr_2 = "n/a";
		
		$owner = null;
		$pet_name = null;
		$breed = null;
		$clm_hrs = null;
		$ph_nmbr_1 = null;
		$ph_nmbr_2 = "n/a";
		$m_file = fopen($this->full_path, "w");
		fwrite($m_file, $this->header);

		foreach ($this->roster as $rstr) {
			$session = $rstr->session;
			$class_t = $rstr->details->title;
			$begin_date = $rstr->begin_date;
			$end_date = $rstr->end_date;
			$day = $rstr->day_of_week;
			if (count($rstr->instructors) >= 1) {
				$instrctr_1 = $rstr->instructors[0]->first_name . " " . 
							  $rstr->instructors[0]->last_name;
			}

			if (count($rstr->instructors) > 1) {
				$instrctr_2 = $rstr->instructors[1]->first_name . " " . 
							  $rstr->instructors[1]->last_name;
			}
			
			foreach ($rstr->pets as $pet) {
				if ($pet->pivot->logged_hours >= $this->num_of_clm_hrs) {
					$owner = $pet->user->user_profile->first_name . " " . 
							 $pet->user->user_profile->last_name;
					$pet_name = $pet->name;
					$breed = $pet->breed;
					$clm_hrs = $pet->pivot->logged_hours;
					if(count($pet->user->user_profile->phone_numbers) > 0) {
						$ph_nmbr_1 = $pet->user->user_profile->phone_numbers[0]->number;
					} else {
						$ph_nmbr_1 = 'none';
					}
					if(count($pet->user->user_profile->phone_numbers) > 1) {
						$ph_nmbr_2 = $pet->user->user_profile->phone_numbers[1]->number;
					}
					$email = $pet->user->email;

					$roster_rec = '"'. $session . '"' . ',' . '"' . $class_t . '"' . ',' . 
								  '"'. $begin_date . '"' . ',' . '"' . $end_date . '"' . ',' .
	                              '"' . $day . '"' . ',' . '"' . $instrctr_1 . '"' . ',' .
	                              '"' . $instrctr_2 . '"' . ',' .
	                              '"' . $owner . '"' . ',' . '"' . $pet_name . '"' . ',' .
	                              '"' . $breed . '"' .',' .
	                              '"' . $clm_hrs . '"' . ',' . '"' . $email . '"' . ',' .
	                              '"' . $ph_nmbr_1 . '"' . ',' .
	                              '"' . $ph_nmbr_2 . '"' .$delmtr;
					fwrite($m_file, $roster_rec);
					$ph_nmbr_2 = "n/a";
					$instrctr_2 = "n/a";
				}
			}
		}
		fclose($m_file);

		//$this->debug();
	}

	public function get_file_path()
	{
		return $this->full_path;
	}

	public function debug()
	{
		echo $this->file_name;
	}

	public function get_roster()
	{
		return $this->roster;
	}
}
