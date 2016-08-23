<?php 

namespace App\Lib;

/**
 * Simple Pagination Helper.  Accepts a (a) collection of models,
 * (b) the number of model objects to display per page, and
 * (c) the current page being viewed.
 * 
 * To use:
 * 1. Supply the above, then
 * 2. $totalNumberOfPages = PaginationHelperObject->get_num_of_pages()
 * 3. $collectionToShowOnCurrentPage = 
 * 									PaginationHelperObject->get_sliced_collection()
 */
class PaginationHelper {

	var $collection;
	var $max_viewable;
	var $num_of_pages;
	var $curr_page;

	public function __construct($collection, $max_viewable, $curr_page)
	{
		$this->collection = $collection;
		$this->max_viewable = $max_viewable;
		$this->num_of_pages = $this->set_num_of_pages();
		$this->curr_page = $curr_page;
	}

	private function set_num_of_pages()
	{
		return ceil(count($this->collection) / $this->max_viewable);
	}

	public function get_sliced_collection()
	{	
		return $this->collection->slice(
						$this->max_viewable * $this->curr_page - 
						$this->max_viewable, $this->max_viewable);
	}

	public function get_num_of_pages()
	{
		return $this->num_of_pages;
	}
}