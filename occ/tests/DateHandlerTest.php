<?php 

use App\Lib\DateHandler;

class DateHandlerTest extends TestCase {

	public function testConstructor()
	{
		// default format to parse to
		$date_handler = new DateHandler('5/21/2016', 'm/d/Y');

		// explicit format to parse to
		$date_handler = new DateHandler('5/21/2016', 'm/d/Y', 'Y-m-d');
	}

	public function testDateWithNoPadding()
	{
		// default format to parse to
		$date_handler = new DateHandler('5/21/2016', 'm/d/Y');
		$this->assertEquals('2016-05-21', $date_handler->get_formatted_date());

		// explicit format to parse to
		$date_handler = new DateHandler('5/21/2016', 'm/d/Y', 'Y-m-d');
		$this->assertEquals('2016-05-21', $date_handler->get_formatted_date());	

		$date_handler = new DateHandler('5/1/2016', 'm/d/Y', 'Y-m-d');
		$this->assertEquals('2016-05-01', $date_handler->get_formatted_date());	

		$date_handler = new DateHandler('10/1/1999', 'm/d/Y', 'Y-m-d');
		$this->assertEquals('1999-10-01', $date_handler->get_formatted_date());	

	}

}