<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';

class pages_editorModel extends modelSuperClass_Core
{
	
	private  $fileNameOfPageXML;
	
	
	public function getPageXML($pagesXML)
	{
		if (isset($_GET['page_selected']))
		{
			$page_selected = $_GET['page_selected'];
	
			//check first if tis a third nav group
			$special_nav_group = $pagesXML->xpath("//page[page_id='".$page_selected."'][special_group_nav=*]");
			if(count($special_nav_group) > 0)
			{
				$group_name  = strval($special_nav_group[0]->special_group_nav);
				$parent_page = strval($special_nav_group[0]->parent_page_id);
				
				$dataHandler = new dataHandler();
				$this->fileNameOfPageXML = 'Data/'.PRIMARY_DOMAIN.'/Content/Pages/'.$group_name.'/'.$parent_page.'/'.$page_selected.'.xml';
				$pageXML = $dataHandler->loadDataSimpleXML($this->fileNameOfPageXML);
			}
			else
			{
				//load the correct page
				$navigationNamesArray = $pagesXML->xpath("//page[page_id='".$page_selected."']/../navigation_group_id");
				$dataHandler = new dataHandler();
					
				//this is for sub nav
				if(count($navigationNamesArray) < 1)
				{
				
					$navigationNamesArray	= $this->getNavigationNameGroupName($pagesXML, $page_selected);
					$currentNavigationGroup = strval($navigationNamesArray[0]);
				
					$parent_pageArray		= $pagesXML->xpath("//page[page_id='".$page_selected."']/../page_id");
				
					$parent_page			= strval($parent_pageArray[0]);
				
					$this->fileNameOfPageXML = 'Data/'.PRIMARY_DOMAIN.'/Content/Pages/'.$currentNavigationGroup.'/'.$parent_page.'/'.$page_selected.'.xml';
					$pageXML = $dataHandler->loadDataSimpleXML($this->fileNameOfPageXML);
				}
					
				else
				{
				
					$currentNavigationGroup = strval($navigationNamesArray[0]);
					$this->fileNameOfPageXML = 'Data/'.PRIMARY_DOMAIN.'/Content/Pages/'.$currentNavigationGroup.'/'.$page_selected.'/data.xml';
					$pageXML = $dataHandler->loadDataSimpleXML($this->fileNameOfPageXML);
				}
			}
			
		}
		else
		{
			//default page
			$navigationNamesArray = $pagesXML->xpath("/pages/navigation_group/page[@xml='default']/../navigation_group_id");
			$currentNavigationGroup = strval($navigationNamesArray[0]);
	
			$defaultPageXML = $pagesXML->xpath("/pages/navigation_group/page[@xml='default']");
			$defaultPage = strval($defaultPageXML[0]->page_id);
	
	
			$this->fileNameOfPageXML = 'Data/'.PRIMARY_DOMAIN.'/Content/Pages/'.$currentNavigationGroup.'/'.$defaultPage.'/data.xml';
	
			$dataHandler = new dataHandler();
			$pageXML = $dataHandler->loadDataSimpleXML('Data/'.PRIMARY_DOMAIN.'/Content/Pages/'.$currentNavigationGroup.'/'.$defaultPage.'/data.xml');
		}
		
		
		return $pageXML;
	}
	
//----------------------------------------------------------------------------------------------------------------------	
	
	public function getNavigationNameGroupName($pagesXML, $page_selected, $parent_xpath = '')
	{
		$parent_xpath .= '/..';
		$navigationNamesArray = $pagesXML->xpath("//page[page_id='{$page_selected}']{$parent_xpath}/navigation_group_id");

		if(count($navigationNamesArray) < 1)
			return $this->getNavigationNameGroupName($pagesXML, $page_selected, '/..');
		else
			return $navigationNamesArray;
	}
//----------------------------------------------------------------------------------------------------------------------	
	
	
// 	public function getNavigationNameGroupName($pagesXML, $page_selected, $parent_xpath = '', $number = 0)
// 	{
// 		for($i = 0; $i < $number; $i++)
// 			$parent_node .= '//..';
		
// 		$navigationNamesArray = $pagesXML->xpath("//page[page_id='{$page_selected}']{$parent_node}/navigation_group_id");


// 		return $this->getNavigationNameGroupName($pagesXML, $page_selected, '/..');
// 	}
	
//----------------------------------------------------------------------------------------------------------------------	
	
	public function getFileNameOfPageXML()
	{
		//getPageXML must be run first
		return $this->fileNameOfPageXML;
	}
	//===========================================================================================================================	
	//===========================================================================================================================
	//===========================================================================================================================	
	//===========================================================================================================================
	
	public function updateDOMObjectWithPOST($ambiguousDomObject)
	{
		//This accept a lot of different object but outputs a DOM
		//used in the updating via a POST
		if ('DOMNodeList' == get_class($ambiguousDomObject))
		{
			$domList = $ambiguousDomObject;
			$dom = new DOMDocument();
			for ($i = 0; $i < $domList->length; $i++)
			{
			$domnode = $dom->importNode($domList->item($i), true);
			$dom->appendChild($domnode);
			$dom = $this->updateDOMObjectWithPOST_internal($dom);
			}
		}
		elseif ('SimpleXMLElement' == get_class($ambiguousDomObject))
		{
			$dom = dom_import_simplexml($ambiguousDomObject);
			$dom = $this->updateDOMObjectWithPOST_internal($dom);
		}
		elseif ('DOMNode' == get_class($ambiguousDomObject))
		{
			print "DOMNode traverseDOM to be done but we want to see if its used"; die;
		}
		elseif ('DOMDocument' == get_class($ambiguousDomObject))
		{
			$dom = $ambiguousDomObject;
			$dom = $this->updateDOMObjectWithPOST_internal($dom);
		}
		elseif ('DOMElement' == get_class($ambiguousDomObject))
		{
			$dom = new DOMDocument();
			$domnode = $dom->importNode($ambiguousDomObject, true);
			$dom->appendChild($domnode);
			$dom = $this->updateDOMObjectWithPOST_internal($dom);
		}
		else
		{
			print "UNKNOWN DATA TYPE in updateDOMObjectWithPOST"; die;
		}
		return $dom;
	}
	//===========================================================================================================================
	
	// CMS Only function
	// To use this you have to make sure that the elements in the POST are numbered
	// sequentially starting from 1
	// It requires a specific input that is created by TraverseDOM and the rendering function in a View
	
	public $idCount; // THIS CAN BE SET BEFORE USING updateDOMObjectWithPOST, USED BY catalogueCMSController, saveItemEditsAction because it updates more than one XML object at a time
	
	public $yui_rte_prefix ='';// bloody catalogueCMSController.
	public function updateDOMObjectWithPOST_internal($dom)
	{
		$grouperCount=1;
	
		if (!isset ($this->idCount)) {
			$idCount=1;
		}
		else {
			$idCount= $this->idCount;
		}
		
		$string = '';
		
		//I cant believe how easy this was....
		//It only took 1 month to study how to use DOM ..
		//If you change a nodelist it changes the underlying dom
		//@todo doesnt deal with attributes!
		$nodes = $dom->getElementsByTagName("*");
		foreach ($nodes as $node)
		{
// 			echo "<pre>";var_dump($node);echo "<pre>";
			if  ($node->nodeType==XML_ELEMENT_NODE)
			{
				if (($node->childNodes->length > 1) AND ($node->nodeName != 'image' AND $node->nodeName != 'attachment'))
				{
					//Do nothing - as its a container/grouping element
				}
				else
				{
					if (isset($_POST[$this->yui_rte_prefix.$idCount]))
					{
						//if there is HTML, put CDATA
						// This is needed too but is repeated in dataHanlder
	
						$string = $_POST[$this->yui_rte_prefix.$idCount];
						
						debug::getInstance()->logVariable($string,'$string',true,'green',true);
						//var_dump($node->nodeName); die;
	
						if ($string=='')
						{
							// a little workaround so that empty xml sections are displayed correctly
							// and posts are saved to the right XML tag
							$string='.';
						}
	
						$string = stripslashes($string);
						$string = strip_tags($string,'<strong><iframe><em><b><i><u><hr><a><sub><sup><blockquote><br><ul><ol><li><img><p><table><tbody><tr><td><h1><h2><h3><h4><h5><h6>');
						//$string = str_replace ( '&#039;', '\'', $string );
						$string = str_replace ( '&quot;', '\"', $string );
						$string = str_replace ( '&lt;', '<', $string );
						$string = str_replace ( '&gt;', '>', $string );
	
						//FOR SOME WEIRD REASON YOU NEED TO HAVE & as & amp;
						//& amp; is the proper way of presenting & in html
						$string = str_replace ( '&', '&amp;', $string);
	
						$pos = strpos($string, '<');
						$pos1 = strpos($string, '&');
	
						if (($pos === false) && ($pos1 === false))
						{
							$node->nodeValue = $string;
						}
						else
						{
							$string = "<![CDATA[".$string."]]>";
							$node->nodeValue = $string;
						}
					}
					elseif(isset($_POST[$this->yui_rte_prefix.$idCount.'_attachment']))
					{
						/** added by kevin baisas 11/14/2014 */
						if($_POST['attachment_checker_'.$this->yui_rte_prefix.$idCount] === "0")
						{
							$accepted_types = array(
								'application/msword',
								'application/pdf',
								'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
								'application/vnd.ms-excel',
								'text/plain'
							);

							$attachment_details = $_POST[$idCount.'_attachment'];

							$exploded_ext 	 = explode(".", $attachment_details['name']);
							$ext 			 = $exploded_ext[count($exploded_ext) - 1];
							$hash_file_name	 = sha1(md5($attachment_details['name'])).".".$ext;

							if(in_array($attachment_details['type'], $accepted_types))
							{
								if(!file_exists('Data/Attachments/'.$hash_file_name))
									move_uploaded_file($attachment_details['tmp_name'], 'Data/Attachments/'.$hash_file_name);

								$attachment_name = str_replace ( '&', '&amp;', $attachment_details['name']);
								$attachment_type = $attachment_details['type'];

								$node->setAttribute('name', $attachment_name);
								$node->setAttribute('hash_file_name', $hash_file_name);
								$node->setAttribute('mime_type', $attachment_type);
								$node_details = "\n\t<path>Data/Attachments/".$hash_file_name."</path>\n\t";
								$node_details .= "\n\t<mime_type>$attachment_type</mime_type>\n\t";
								$node->nodeValue = $node_details;
							}
							else
							{
								$node->setAttribute('name', "");
								$node->setAttribute('hash_file_name', "");
								$node->setAttribute('mime_type', "");
								$node_details = "\n\t<path></path>\n\t";
								$node_details .= "\n\t<mime_type></mime_type>\n\t";
								$node->nodeValue = $node_details;
							}
						}
						else
						{
							$attachment_details = json_decode($_POST['attachment_checker_'.$this->yui_rte_prefix.$idCount], TRUE);
							$node->setAttribute('name', $attachment_details['name']);
							$node->setAttribute('hash_file_name', $attachment_details['hash_file_name']);
							$node->setAttribute('mime_type', $attachment_details['mime_type']);
							$node_details = "\n\t<path>Data/Attachments/".$attachment_details['hash_file_name']."</path>\n\t";
							$node_details .= "\n\t<mime_type>".$attachment_details['mime_type']."</mime_type>\n\t";
							$node->nodeValue = $node_details;
						}
						$node_details = "";
					}
					elseif(isset($_POST[$this->yui_rte_prefix.$idCount.'_image']))
					{
						
						$image_id 		= $_POST[$idCount.'_image'];
						
						//get image details
						$image_details  = $this->getImageDetails($image_id);
						$full_path 		= $image_details["album_folder"]."/{$image_details["dimensions"]}/{$image_details["path"]}";
						$thumbnail_path = $image_details["album_folder"]."/{$image_details["dimensions"]}_thumb/{$image_details["path"]}";
						$image_caption	= $image_details["image_caption"];
						$image_title	= $image_details["image_title"];
						
						@list($width, $height) = @explode("x", $image_details["dimensions"]);
						
						$node->setAttribute('id', $image_id);
						$node_details = "\n\t<alternative_text>$image_title</alternative_text>\n\t";
						$node_details .= "<path>$full_path</path>\n\t";
						$node_details .= "<thumbnail_path>$thumbnail_path</thumbnail_path>\n\t";
						$node_details .= "<height>$height</height>\n\t";
						$node_details .= "<width>$width</width>\n\t";
						$node_details .= "<caption>$image_caption</caption>\n";
						$node->nodeValue = $node_details;
						$node_details = "";
					}
					 
					$idCount++;
				}
			}
		}

		return $dom;
	}
	
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function getImageDetails($image_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "SELECT
								 i. * , 
								 s. * ,
								 a. *
							FROM
							   images i
							LEFT JOIN 
						   		album_image_sizes s 
						   	ON
						   		 i.size_id = s.size_id
						   	LEFT JOIN
						   		albums a
						   	ON
						   		a.album_id = i.album_id
							WHERE
								 i.image_id = :image_id
							";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":image_id", $image_id, PDO::PARAM_INT);
			$pdo_statement->execute();
	
			$results = $pdo_statement->fetch(PDO::FETCH_ASSOC);
			return $results;
		}
		catch(PDOException $e)
		{
			echo "<pre>".$e->getMessage();
		}
	}

	
}
?>