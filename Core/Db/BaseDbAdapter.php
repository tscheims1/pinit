<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Db;

/**
 * Just an abstract baseClass for dbAdapters
 */
abstract class BaseDbAdapter
{
	/**
	 * instance of the adapter
	 * @var \Core\Db\BaseDbAdapter
	 */
	protected static $instance = null;
	
	/**
	 * Singleton Pattern
	 */
	public static function getInstance()
	{
		if(self::$instance === null)
			self::$instance = new static();
		return self::$instance;
	}
	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}
	
	/**
	 * Database Setup 
	 * @param array $config the database Configuaration e.g: db name, pass,ect
	 */
	public abstract function setUp(array $config);
	
	/**
	 * store a Collection in the database
	 * @param array $collection
	 */
	public abstract function saveCollection(array $collection);
	
	/**
	 * find one or more model and return it as a collection
	 * @param array $query the databaseQuery
	 */
	public abstract function findCollection(array $query);
}
?>