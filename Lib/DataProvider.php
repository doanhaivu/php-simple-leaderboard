<?php
require_once 'Utilities.php';

$CONFIG['secret'] = 'NwvprhfBkGuPJnjJp77UPJWJUpgC7mLz';

class DataProvider
{
	static private $DB_SERVER = '127.0.0.1';
	static private $DB_PORT = 11211;
	static private $memObj;
	
	static public function init()
	{
		$memObj = new Memcached();
		$memObj->addServer(DataProvider::$DB_SERVER, DataProvider::$DB_PORT);      
		self::$memObj  = & $memObj;
	}

	static function get($key)
	{    
		$data = self::$memObj->get($key);
		return $data;
	}

	static function set($key,$data)
	{    
		self::$memObj->set($key,$data);    
	}

	static function delete($key)
	{
		self::$memObj->set($key, NULL);
	}
}

DataProvider::init();
