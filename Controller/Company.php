<?php

class Company
{

	public static function get()
	{
		$cmsSmo = new cmsSMO();
		$website = $cmsSmo->getWebsite();

		if ($website) {
			$companyId = $website['company'];
		} else {
			return false;
		}

		$conn = $cmsSmo->sqlQuery();
		$companySql = "SELECT * FROM company WHERE id=" . $companyId;
		$companyResult = $conn->query($companySql);

		if ($companyResult->num_rows > 0) {
			return $companyResult->fetch_assoc();
		}

		if ($companyResult->num_rows === 0) {
			$companySql = "SELECT * FROM company";

			$companyResult = $conn->query($companySql);

			if ($companyResult->num_rows > 0) {
				return $companyResult->fetch_assoc();
			} else {
				return false;
			}
		}
	}
}
