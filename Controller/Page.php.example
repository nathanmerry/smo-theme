<?php

class Page
{
	public static function get($slug)
	{
		$cmsSmo = new cmsSMO();
		$conn = $cmsSmo->sqlQuery();
		$sql = "SELECT * FROM pages WHERE slug='" . $slug . "'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			return $result->fetch_assoc()['content'];
		} {
			return false;
		}
	}
}
