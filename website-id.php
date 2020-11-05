<?php

class WebsiteID
{
	public $id;

	function __construct()
	{
		$websites = json_decode(file_get_contents('../websites.json'), true);
		$key = array_search($_SERVER['HTTP_HOST'], array_column($websites, 'name'));
		$this->id = $websites[$key]['id'];
	}
}

$websiteId = new WebsiteID();
$websiteId = $websiteId->id;
