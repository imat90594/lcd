<?php 
/**
 * @author Raymart Marasigan
 * @date 8/6/2014
 * @description   - This class handles data throwned by Paginated class
 * @dependencies  - Paginated class (http://www.sitepoint.com/examples/pagination/paginated-demo.zip)
 * 
 */

require_once "Project/1_Website/Code/Modules/pagination/src/Paginated.php";
require_once "Project/1_Website/Code/Modules/pagination/src/DoubleBarLayout.php";
require_once "Project/1_Website/Code/Modules/pagination/src/TrailingLayout.php";

class pagination
{
	/**
	 *  
	 * @property integer $limit - number of data that will be displayed by this class
	 * @property integer $current_page - number of page where are you in.
	 * @property str $pagination- html string containing the gui of pagination
	 * @property array $result - array of paginated result
	 * @property boolean $use_double_bar - tells whether what pagination template to be used(DoubleBar or Trailing)
	 * 
	 */
	
	public $limit;
	public $current_page;
	public $pagination;
	public $result;
	public $use_double_bar = TRUE;
	
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @description paginate data and set the information on its classes
	 * @params array data - array of data that will be paginated (any form of array is accepted)
	 *
	 */
	
	public function paginateData($data)
	{
		//paginate the result
		$result = new Paginated($data, $this->limit, $this->current_page);

		//get  the pagination gui
		if($this->use_double_bar == TRUE)
			$result->setLayout(new DoubleBarLayout());
		else
			$result->setLayout(new TrailingLayout());
			
		//set the pagination gui
		$this->pagination =  $result->fetchPagedNavigation();
		
		//set the result
		$this->result = $result->fetchResult();
	}
}
?>