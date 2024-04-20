<?php
namespace app;
use library\DB;
use Config;

abstract class Model
{
	public $DB;
	public function __construct() {
		
		global $cfg;
		$this->DB = new DB( Config::DB_HOST, Config::DB_NAME, Config::DB_USER, Config::DB_PASS, Config::DEBUG_MODE );
	}
}