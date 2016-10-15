<?php

namespace App\Lib;

use Exception;
use App\Classes;
use App\ClassesDetail;
use App\Instructor;
use Log;

class ScheduleUploader {

	var $schedule_file;
	var $num_of_records;
	var $num_of_duplicates;
	var $num_of_naming_errors;
	var $return_array = array();

	public function __construct($path_to_file)
	{
		$this->schedule_file = $path_to_file;
		$this->num_of_records = 0;
		$this->num_of_duplicates = 0;
	}

	public function update()
	{
		if (($handle = fopen($this->schedule_file, "r")) !== FALSE) {
			fgetcsv($handle);   
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				for ($c=0; $c < $num; $c++) {
					$col[$c] = $data[$c];
				}

				$session = $col[0];
				$class_id = $this->get_class_id($col[1]);
				$day_of_week = $col[2];
				$time = $col[3];
				$begin_date = $col[4];
				$end_date = $col[5];
				$entrance = $col[6];
				$capacity = $col[7];
				$instructor = $this->get_instructor($col[8]);
				$is_open = $col[9];

				$begin_date = $this->parse_date($begin_date);
				$end_date = $this->parse_date($end_date);

				try {

					if ($class_id === null) {
						throw new Exception();
					}

					$class = Classes::create([    // insert new class
						'day_of_week' => $day_of_week, 'begin_date' => $begin_date,
						'end_date' => $end_date, 'entrance' => $entrance,
						'capacity' => $capacity, 'vacant' => $capacity,
						'on_hold' => 0, 'class_details_id' => $class_id,
						'session' => $session, 'time' => $time,
						'locked' => 0, 'is_open' => $is_open
					]);
					
					if ($instructor === null) {
						throw new Exception();
					}
					$class->instructors()->attach($instructor);

					$class->save();
					$this->num_of_records++;
				} catch (\Illuminate\Database\QueryException $e) {
					$this->return_array[$this->num_of_duplicates] = 'Class ID: ' . $class_id . 
																	', Class Title: ' .  $col[1]  .
																	', begin date: '. $begin_date .
																	', end date: ' . $end_date .
																	', time: ' . $time; 

		            $this->num_of_duplicates++;
		            Log::alert('Upload failure: Duplicate Class ID: ' . $class_id . 
																	', begin date: '. $begin_date .
																	', end date: ' . $end_date .
																	', time: ' . $time); 
		            Log::alert($e);
				} catch (Exception $e) {
					Log::alert('Upload failure (Unknown) Class or (Unkown) Instructor: ' . $class_id .
																	', instructor: '. $instructor .	 
																	', begin date: '. $begin_date .
																	', end date: ' . $end_date .
																	', time: ' . $time); 
					$this->num_of_naming_errors++;
				}
				
			}
			fclose($handle);
			return 0;                 // processed properly
		}
	}

	public function get_duplicate_results()
	{
		return $this->return_array;
	}

	public function get_num_of_new_records()
	{
		return $this->num_of_records;
	}

	public function get_num_of_naming_errors()
	{
		return $this->num_of_naming_errors;
	}

	protected function parse_date($date)
	{
		$date_prs;
		$mnth;
		$day;
		$date_arry = date_parse($date);
		if ($date_arry['month'] < 10) {
			$mnth = '0'. $date_arry['month'];
		} else {
			$mnth = $date_arry['month'];
		}  
		if ($date_arry['day'] < 10) {
			$day = '0'. $date_arry['day'];
		} else {
			$day = $date_arry['day'];
		}  
		$date_prs = $date_arry['year'] . '-' . $mnth . '-' . $day;		
		return $date_prs;
	}

	// get class id given the class title
	protected function get_class_id($class_name)
	{
		$class = ClassesDetail::where('title', '=', $class_name)->first();
		if ($class === null) {
			return null;
		}
		return $class->id;
	}

	// get instructor model given the last name
	protected function get_instructor($inst_lname)
	{
		return Instructor::where('last_name', '=', $inst_lname)->first();
	}

}