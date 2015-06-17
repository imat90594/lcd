<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php');


class online_formModel extends modelSuperClass_Core
{
	public function buildDates($dates, $data)
	{
		foreach($dates as $date_name)
		{
			$data[$date_name] = $data[$date_name."_days"]."-".$data[$date_name."_months"]."-".$data[$date_name."_years"];
			unset($data[$date_name."_days"]);
			unset($data[$date_name."_months"]);
			unset($data[$date_name."_years"]);
		}
		
		return $data;
	}
	
	
	public function buildEmailTemplate($data)
	{
		
		
		$email_template = "
			
			<div style='font-family:arial;'>
			<div><b>{$data["first_name"]} {$data["middle_name"]} {$data["last_name"]} - {$this->computeAge($data["date_of_birth"])}-{$data["rank_applied"]}-{$data["preferred_ship_type"]}</b></div>
			<table>
				<tr>
					<td>Date Application</td>
					<td>".date("d-M-Y")."</td>
				</tr>
				
				<tr>
					<td>Date of Birth </td>
					<td>{$data["date_of_birth"]}</td>
				</tr>
				
				<tr>
					<td>Age </td>
					<td>{$this->computeAge($data["date_of_birth"])}</td>
				</tr>
				
				<tr>
					<td>Rank Applied for</td>
					<td>{$data["rank_applied"]}</td>
				</tr>
				
				<tr>
					<td>Preferred ship type</td>
					<td>{$data["preferred_ship_type"]}</td>
				</tr>
				
				<tr>
					<td>Availability Date</td>
					<td>{$data["available_date"]}</td>
				</tr>
				
				<tr>
					<td>Salary Expectation</td>
					<td>{$data["salary_expectation"]}</td>
				</tr>
		</table>
				
				<div style='background-color:#548DD4'><b>Contact Details</b></div>
		
			<table style='font-family:arial;'>
				<tr>
					<td>Address</td>
					<td>{$data["address"]}</td>
				</tr>
				
				<tr>
					<td>Mobile number</td>
					<td>{$data["mobile_number"]}</td>
				</tr>
				
				<tr>
					<td>Landline number</td>
					<td>{$data["landline_number"]}</td>
				</tr>
				
				<tr>
					<td>Email</td>
					<td>{$data["email"]}</td>
				</tr>
			</table>
			";
		
		$email_template .= "<div style='background-color:#548DD4'><b>SEA SERVICE</b></div>";
	
		$email_template .= "<table style='font-family:arial;'>";
		$i = 1;
		foreach($data["service"] as $service)
		{
			$email_template .= "
			
					<tr>
						<td><b>Sea Service $i<b></td>
					<tr>
					
					<tr>
						<td>Rank</td>
						<td>{$service['rank']}</td>
					</tr>
					
					<tr>
						<td>Vessel Type</td>
						<td>{$service['ship_type']}</td>
					</tr>
					
					<tr>
						<td>Vessel Name</td>
						<td>{$service['ship_name']}</td>
					</tr>
					
					<tr>
						<td>Flag</td>
						<td>{$service['flag']}</td>
					</tr>
					
					<tr>
						<td>Engine Type</td>
						<td>{$service['engine_make']}</td>
					</tr>
					
					<tr>
						<td>GRT/KW</td>
						<td>{$service['grt']}</td>
					</tr>
					
					<tr>
						<td>Manning Agency</td>
						<td>{$service['manning_agency']}</td>
					</tr>
					
					<tr>
						<td>Principal</td>
						<td>{$service['principal']}</td>
					</tr>
					
					<tr>
						<td>Sign on</td>
						<td>{$service['from_date_days']}-{$service['from_date_months']}-{$service['from_date_years']}</td>
					</tr>
					
					<tr>
						<td>Sign Of</td>
						<td>{$service['to_date_days']}-{$service['to_date_months']}-{$service['to_date_years']}</td>
					</tr>
					
					<tr>
						<td>Months</td>
						<td>
							{$this->computeMonths($service['from_date_days'].'-'.$service['from_date_months'].'-'.$service['from_date_years'],
							$service['to_date_days'].'-'.$service['to_date_months'].'-'.$service['to_date_years'])}
						</td>
					</tr>
					
					
				";
				
			$i++;
		}
		$email_template .= "</table>";
		$email_template .= "<div style='background-color:#548DD4'><b>Additional Skills / Certification / Experience (incl landbassed)</b></div><div><p>{$data['additional_skills']}</p></div>";
		$email_template .= "<div style='background-color:#548DD4'><b>Documentation</b></div>";
		$email_template .= "<table style='font-family:arial;'>
			<tr>
				<td>Passport Number : {$data['passport_number']}</td>
				<td>Valid Until : {$data['passport_validity']}</td>
			</tr>
			<tr>
				<td>Seamans Book Number: {$data['seamans_number']}</td>
				<td>Valid Until : {$data['seamans_validity']}</td>
			</tr>
			<tr>
				<td>COC Number: {$data['coc_number']}</td>
				<td>Valid Until : {$data['coc_validity']}</td>
				<td>Level : {$data['coc_level']}</td>
			</tr>
			<tr>
				<td>Visa (if any): {$data['us_visa']}</td>
				<td>Valid Until : {$data['us_visa_validity']}</td>
			</tr>
		</table>
		
		</div>
		";
		
		return $email_template;
	}
	
	
	private function computeAge($birthDate)
	{
		$birthDate = date("m/d/Y", strtotime($birthDate));
		//explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
		//get age from date or birthdate
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
	
		return $age;
	}
	
	private function computeMonths($from, $to)
	{
		$date1 = $from;
		$date2 = $to;
		
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);
		
		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);
		
		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);
		
		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		
		return $diff;
	}
	
}