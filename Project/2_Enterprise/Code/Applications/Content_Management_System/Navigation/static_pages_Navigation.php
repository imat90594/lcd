<?php   
class staticPagesNavigation 
{
	public $pagesXML;
    
	public static  function displayStaticPagesNavigation()
    {
        $content = "";
        $dataHandler = new dataHandler();
        $pagesXML = $dataHandler->loadDataSimpleXML('Project/1_Website/Code/Pages/pages_navigation.xml');
        
	    $content =  self::getPrimaryNav($pagesXML->navigation_group);
        return $content;
    }
    
    //---------------------------------------------------------------------------------------
    
    private static function getPrimaryNav($xmlObj)
    {
    	$active = "";
    	
    	$list = '<div id="heading" class="pAl"><span class="glyphicon glyphicon-folder-open mRs"></span><h3>YOUR PAGES</h3></div>';
    	$list .= '<div id="sideNavigation" class="clearfix">';
    	
    	$top_url_name 		  = routes::getInstance()->getCurrentTopLevelURLName();
    	$application 		  = applicationsRoutes::getInstance()->getCurrentControllerURLName();
    	 
    	//loop for navigation group. e.g primary_nav, sencondary_nav
    	foreach($xmlObj as $pages)
    	{
    		//loop for primary pages e.g. home, about, profile
    		$list .= '<ul id="nav_list" class="unstyled">';
    		foreach($pages as $page)
    		{
    			//link for text
    			$link_text  = strval($page->link_text);
    			
    			///attributes of the page
    			$attributes = $page->attributes();
    			
    			//if page id is equal to page selected on the url
    			if(isset($_GET['page_selected']))
    				if($page->page_id == $_GET['page_selected'])
    					$active = 'active"';
    			
    			//if link is blank it means the navigation is a parent nav
    			//therefore it has no attributes(it contains pages)
    			//hide this nav if it has an attribute of cms=hide
    			if ($link_text != "" && $attributes["cms"] != "hide")
    			{
	    			 //if there is sub nav get the <ul></ul>
	    			// on hte getSubNav method and close it with </li>
	    			if(count($page->page))
	    			{
		    			$list .= "<li class='hasSecond'><span class='nav'><a href='/$top_url_name/$application?page_selected=$page->page_id'>$link_text</a></span>";
		    			$list .= self::getSubNav($page->page); //<ul></ul>3
	    				$list .= "</li>"; //closing li of primary nav
	    			}
	    			//display primary nav
	    			else
	    			{
		    			$list .= "<li><span class='nav'><a href='/$top_url_name/$application?page_selected=$page->page_id'>$link_text</a></nav></li>";
	    			}
    			}
    		}
    		$list .= "</ul>";
    	}
    	
    	$list .= "</div>";
    	
		return $list;
    }
    
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    private static function getSubNav($pages)
    {
    	$list   = "";
    	$active = "";
    	 
    	$top_url_name 		  = routes::getInstance()->getCurrentTopLevelURLName();
    	$application 		  = applicationsRoutes::getInstance()->getCurrentControllerURLName();
    	
    	
			//loop for sub nav pages e.g. home, about, profile
    		$list .= '<ul class="unstyled subNav pLm">';
    		foreach($pages as $page)
    		{
    			//link for text
    			$link_text  = strval($page->link_text);
    			
    			///attributes of the page
    			$attributes = $page->attributes();
    			
    			//if page id is equal to page selected on the url
    			if(isset($_GET['page_selected']))
    				if($page->page_id == $_GET['page_selected'])
    					$active = 'active"';
    			
    			//if link is blank it means the navigation is a parent nav
    			//therefore it has no attributes(it contains pages)
    			//hide this nav if it has an attribute of cms=hide
    			if ($link_text != "" && $attributes["cms"] != "hide")
    			{
	    			 //if there is sub nav get the <ul></ul>
	    			// on hte getSubNav method and close it with </li>
	    			if(count($page->page))
	    			{
		    			$list .= "<li class='hasSecond'><span class='nav'><a href='/$top_url_name/$application?page_selected=$page->page_id'>$link_text</a></span>";
		    			$list .= self::getSubNav($page->page); //<ul></ul>3
	    				$list .= "</li>"; //closing li of sub nav
	    			}
	    			//display primary nav
	    			else
	    			{
		    			$list .= "<li><span class='nav'><a href='/$top_url_name/$application?page_selected=$page->page_id'>$link_text</a></nav></li>";
	    			}
    			}
    		}
    		$list .= "</ul>";
    		
    	return $list;
    }
    
    
}
