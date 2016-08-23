<?php 

use App\Lib\ScheduleUploader;

class ScheduleUploaderTest extends TestCase {

	public function testConstructor()
	{
		$file_location = '/var/www/html/schedule_data/test_data';
		$scheduler = new ScheduleUploader($file_location);
	}

	public function testUpdate()
	{
		$file_location = '/var/www/html/schedule_data/test_data';
		$scheduler = new ScheduleUploader($file_location);

		$return_code = $scheduler->update();

		$this->assertEquals(0, $return_code);
	}

}