<?php

namespace App\Lib;


class FileManager {

	var $target_dir;
	var $target_file;
	var $input_file;
	var $ok_to_upload;
	var $max_file_size = 500000;   // max size of 500 KB
	var $file_types = array("csv", "txt");

	public function getCurrentDir()
	{
		return $this->target_dir;
	}

	public function setCurrentDir($dir)
	{
		$this->target_dir = $dir;
	}

	public function getTargetFile()
	{
		return $this->target_file;
	}

	public function setTargetFile($file_n)
	{
		$this->target_file = $this->target_dir . $file_n;
	}

	public function getInputFile()
	{
		return $this->target_file;
	}

	public function setInputFile($file_n)
	{
		$this->target_file = $file_n;
	}

	public function alreadyExist()
	{
		if (file_exists($target_file)) {
    		$this->ok_to_upload = 0;
    		return true;
		}
		$this->ok_to_upload = 1;
		return false;
	}

	public function fileSizeCheck($file_size)
	{
		if ($this->max_file_size < $file_size) {
			return false;
			$this->ok_to_upload = 0;
		}
		$this->ok_to_upload = 1;
		return true;
	}

	public function fileTypeCheck($file_type)
	{
		foreach ($this->file_types as $accepted_file_type) {
			if ($accepted_file_type == $file_type) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Facade function handles the uploading process.  Includes error
	 * checking.
	 *
	 * @return integer.  The results of attempting a file upload
	 * 
	 * 		   0 =  upload succesful
	 * 		   13 = unknown error
	 */
	public function upload_file()
	{
		if(move_uploaded_file($this->input_file, $this->target_file)) {
			return 0;
		}
		return 13;
	}
}