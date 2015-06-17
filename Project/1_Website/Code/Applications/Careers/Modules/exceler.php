<?php

require_once 'Project/1_Website/Code/Applications/Careers/Modules/Classes/PHPExcel/IOFactory.php';

class exceler
{
	public $template_location;
	
	public $excel_location;
	public $error;
	public $data;
	
	private $excel_object;
	
	public static $mapper = array(
		"first_name" 		 => "BH33",
		"middle_name" 		 => "CX33",
		"last_name"			 => array("S33", "HD21"),
		"date_of_birth"      => "U39",
		"age"				 => "AT39",
		"available_date"	 => "",
		"address"			 => "Y45",
		"mobile_number"		 => "FN39",
		"landline_number"	 => "FN33",
		"email"				 => "FN45",
		"rank_applied"		 => array("X11", "EK33", "HD15"),
		"nationality"		 => "CY63",
		"passport_number"    => "T63",
		"passport_validity"  => "BC63",
		"seamans_number"	 => "T57",
		"seamans_validity"	 => "BC57",
		"coc_number"		 => "T69",
		"coc_level"			 => array("CH69", "X20"),
		"coc_validity"	 	 => "BC69",
		"us_visa"			 => "T75",
		"us_visa_validity"	 => "BC75",
		"additional_skills"	 => "A84",
		"preferred_ship_type"=> array("X14", "EI39"),
		"salary_expectation" => array("EI45", "X17")
	);
	
	public function __construct()
	{
		$this->template_location = STAR_SITE_ROOT."/Data/FormTemplate/application.form.new.xls";
	}
	
	//---------------------------------------------------------------------------------------
	
	public function fillExcelTemplate()
	{
		$objTpl = PHPExcel_IOFactory::load($this->template_location);
		$objTpl->setActiveSheetIndex(0);  //set first sheet as active
		
		foreach($this->data as $index => $value)
		{
			$coordinate = isset(self::$mapper[$index]) ? self::$mapper[$index] : false;
			
			//check if the post is existing in the mapper
			if($coordinate)
			{
				//check if the value is an array
				if(is_array($coordinate))
				{
					foreach($coordinate as $coord)
						$objTpl->getActiveSheet()->setCellValue($coord, $value);
				}
				else
					$objTpl->getActiveSheet()->setCellValue($coordinate, $value);
			}
		}
		
		$this->excel_object = $objTpl;
	}
	
	public function saveApplicationForm($path)
	{
		$objTpl = $this->excel_object;
		
		$objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');
		$objWriter->save($path);
	}
	
	//---------------------------------------------------------------------------------------
	
	public function fillPhoto($photo)
	{			
		//set the PHPExcel Reader
		$objExcelDrawing = new PHPExcel_Worksheet_Drawing();
		
		$objExcelDrawing->setPath($photo);
		$objExcelDrawing->setCoordinates('FG3');
		$objExcelDrawing->setResizeProportional(false);
		$objExcelDrawing->setHeight(136);
		$objExcelDrawing->setWidth(160);
		$objExcelDrawing->setWorksheet($this->excel_object->getActiveSheet());
	}
	
	//---------------------------------------------------------------------------------------
	
	public function fillSeaService($services)
	{
		if($services)
		{
			$objTpl = $this->excel_object;
			
			$start_ctr = 109; //based on excel template
			$service_counter = 0;
			foreach($services as $service)
			{
				$objTpl->getActiveSheet()->setCellValue("A$start_ctr", $service["ship_name"]);
				$objTpl->getActiveSheet()->setCellValue("T$start_ctr", $service["ship_type"]);
				$objTpl->getActiveSheet()->setCellValue("AB$start_ctr", $service["flag"]);
				$objTpl->getActiveSheet()->setCellValue("AL$start_ctr", $service["grt"]);
				$objTpl->getActiveSheet()->setCellValue("AU$start_ctr", $service["rank"]);
				$objTpl->getActiveSheet()->setCellValue("BC$start_ctr", $service["from_date_days"].'-'.$service["from_date_months"].'-'.$service["from_date_years"]);
				$objTpl->getActiveSheet()->setCellValue("BO$start_ctr", $service["to_date_days"].'-'.$service["to_date_months"].'-'.$service["to_date_years"]);
				$objTpl->getActiveSheet()->setCellValue("CA$start_ctr", $service["engine_make"]);
				$objTpl->getActiveSheet()->setCellValue("CV$start_ctr", $service["engine_kw"]);
				$objTpl->getActiveSheet()->setCellValue("EB$start_ctr", $service["manning_agency"]);
				$objTpl->getActiveSheet()->setCellValue("EW$start_ctr", $service["principal"]);
				$start_ctr += 6;
				
				if($service_counter == 7)
					break;
				else
					$service_counter++;
			}
	
			//if the services is greater than 7
			if(count($services) > 7)
			{
				$start_ctr = 4;
				$objTpl->setActiveSheetIndex(1);
				foreach(range(7, count($services)) as $i)
				{
					$objTpl->getActiveSheet()->setCellValue("A$start_ctr", $services[$i]["ship_name"]);
					$objTpl->getActiveSheet()->setCellValue("B$start_ctr", $services[$i]["ship_type"]);
					$objTpl->getActiveSheet()->setCellValue("C$start_ctr", $services[$i]["flag"]);
					$objTpl->getActiveSheet()->setCellValue("D$start_ctr", $services[$i]["grt"]);
					$objTpl->getActiveSheet()->setCellValue("E$start_ctr", $services[$i]["rank"]);
					$objTpl->getActiveSheet()->setCellValue("F$start_ctr", $services[$i]["from_date_days"].'-'.$services[$i]["from_date_months"].'-'.$services[$i]["from_date_years"]);
					$objTpl->getActiveSheet()->setCellValue("G$start_ctr", $services[$i]["to_date_days"].'-'.$services[$i]["to_date_months"].'-'.$services[$i]["to_date_years"]);
					$objTpl->getActiveSheet()->setCellValue("H$start_ctr", $services[$i]["engine_make"]);
					$objTpl->getActiveSheet()->setCellValue("I$start_ctr", $services[$i]["engine_kw"]);
					$objTpl->getActiveSheet()->setCellValue("K$start_ctr", $services[$i]["manning_agency"]);
					$objTpl->getActiveSheet()->setCellValue("L$start_ctr", $services[$i]["principal"]);
					$start_ctr++;
				}
			}
			
			$objTpl->setActiveSheetIndex(0);
		}
	}
	
	
}
?>