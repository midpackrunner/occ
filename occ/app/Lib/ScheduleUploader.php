<?php

namespace App\Lib;

use App\Classes;
use App\Instructor;
use Log;

class ScheduleUploader {

	var $schedule_file;
	var $num_of_records;
	var $num_of_duplicates;
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
				$class_id = $col[1];
				$day_of_week = $col[2];
				$time = $col[3];
				$begin_date = $col[4];
				$end_date = $col[5];
				$entrance = $col[6];
				$capacity = $col[7];
				$instructor_id = $col[8];
				$is_open = $col[9];

				$begin_date = $this->parse_date($begin_date);
				$end_date = $this->parse_date($end_date);

				try {
					$class = Classes::create([    // insert new class
						'day_of_week' => $day_of_week, 'begin_date' => $begin_date,
						'end_date' => $end_date, 'entrance' => $entrance,
						'capacity' => $capacity, 'vacant' => $capacity,
						'on_hold' => 0, 'class_details_id' => $class_id,
						'session' => $session, 'time' => $time,
						'locked' => 0, 'is_open' => $is_open
					]);
					
					$instructor = Instructor::findOrFail($instructor_id);
					$class->instructors()->attach($instructor);

					$class->save();
					$this->num_of_records++;
				} catch (\Illuminate\Database\QueryException $e) {
					$this->return_array[$this->num_of_duplicates] = 'Class ID: ' . $class_id . 
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
					Log::alert('Upload failure (Unknown) Class ID: ' . $class_id . 
																	', begin date: '. $begin_date .
																	', end date: ' . $end_date .
																	', time: ' . $time); 

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

}