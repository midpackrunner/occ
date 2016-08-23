<?php


namespace App\Lib;

use App\UserProfile;
use Carbon\Carbon;


/**
* 
*/
class MemberFileManager
{
	private $filter;
	private $file_name;
	private $path_to_file;
	private $members;
	private $full_path;
	private $header;

	function __construct($filter)
	{
		$this->filter = $filter;
		$this->set_members($this->filter);
		$this->file_name = 'Members.csv';
		$this->path_to_file = config('app.temp_folder');
		$this->full_path = $this->path_to_file . $this->file_name;
		$this->header = $this->get_header();
	}


	/** Get members based on filter **/
	protected function set_members($fltr)
	{
        switch($fltr) {
            case 'none':
                $user_profiles = UserProfile::orderBy('last_name')
                                 ->orderBy('last_name')->get();
            break;
            case 'student_membership';
                $user_profiles = UserProfile::isStudentMember()
                                 ->orderBy('last_name')->get();
            break;
            case 'regular_membership';
                $user_profiles = UserProfile::isRegularMember()
                                 ->orderBy('last_name')->get();
            break;
            case 'expired_membership';
                $user_profiles = UserProfile::hasExpiredMembership()
                                 ->orderBy('last_name')->get();
            break;       
            default:
                $user_profiles = UserProfile::orderBy('last_name')->get();
        }
        $this->members = $user_profiles;
	}

	protected function get_header()
	{
		return '"First Name",' . '"Last Name",' .  '"Primary Phone",'.'"Street Address",' . '"City",' .
			   '"State",' . '"Zip",' . '"Membership Type",' . "\"Membership Expiration\" \n";
	}

	public function write_to_file()
	{	
		$delmtr = "\n";
		$f_nm = null;
		$l_nm = null;
		$prmry_phone = null;
		$st_addr = null;
		$city = null;
		$state = null;
		$zip = null;
		$mem_type = null;
		$mem_end_dt = null;
		$m_file = fopen($this->full_path, "w");
		fwrite($m_file, $this->header);

		foreach ($this->members as $usr_prf) {
			$f_nm = $usr_prf->first_name;
			$l_nm = $usr_prf->last_name;
			$prmry_phone = $usr_prf->phone_numbers->first()->number;
			$st_addr = $usr_prf->street_address;
			$city = $usr_prf->city;
			$state = $usr_prf->state;
			$zip = $usr_prf->zip;
			if ($usr_prf->membership != null) {
				$mem_type = $usr_prf->membership->membership_type->name;
				$mem_end_dt = $usr_prf->membership->end_date;
			} else {
				$mem_type = null;
				$mem_end_dt = null;
			}
			$usr_prf_recrd = '"'. $f_nm . '"' . ',' . '"' . $l_nm . '"' . ',' . '"' .
							 $prmry_phone . '"' . ',' . '"' .
			                 $st_addr . '"' . ',' . '"' . $city . '"' . ',' . '"' . 
			                 $state . '"' . ',' . '"' . $zip . '"' . ',' . '"' .
							 $mem_type . '"' . ',' .  '"' . $mem_end_dt . '"' . $delmtr;
			fwrite($m_file, $usr_prf_recrd);
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
}
