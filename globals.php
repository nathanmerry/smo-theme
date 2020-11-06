<?php

class cmsSMO
{
	public $websiteID;
	public $databaseSeverName;
	public $databaseName;
	public $databaseUsername;
	public $databasePassword;
	public $dbServerName = "127.0.0.1";


	function __construct()
	{
		$this->websiteID = $this->getWebsiteID();
		$this->databaseSeverName = '127.0.0.1';
		$this->databaseName = 'smoCMS';
		$this->databaseUsername = 'root';
		$this->databasePassword = '';
	}

	function getWebsiteID()
	{
		$websites = json_decode(file_get_contents(__DIR__ . '/websites.json'), true);
		$key = array_search($_SERVER['HTTP_HOST'], array_column($websites, 'name'));
		return $websites[$key]['id'];
	}
}