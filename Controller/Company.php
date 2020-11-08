<?php

class Company
{

	public static function get()
	{
		$cmsSmo = new cmsSMO();
		$conn = $cmsSmo->sqlQuery();

		$websiteSql = "SELECT * FROM website WHERE id=" . $cmsSmo->websiteID;
		$websiteResult = $conn->query($websiteSql);

		if ($websiteResult->num_rows > 0) {
			$companyId = $websiteResult->fetch_assoc()['company'];
		} else {
			return false;
		}
		
		$companySql = "SELECT * FROM company WHERE id=" . $companyId;
		$companyResult = $conn->query($companySql);
		
		if ($companyResult->num_rows > 0) {
			return $companyResult->fetch_assoc();
		} {
			return false;
		}
	}
}
