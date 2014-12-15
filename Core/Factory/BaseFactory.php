<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Factory; 


/**
 * A baseFactory: 
 * Implements Singleton Pattern
 * 
 */
abstract class BaseFactory
{
	/**
	 * protected instance for singleton pattern.
	 * @var BaseFactory
	 */
	protected static $instance = null;
	private function __clone(){}
	private function __wakeup(){}
	
	
	/**
	 * Static Method for getting the instance (Singleton Pattern)
	 * @return BaseFactory
	 */
	public static function getInstance()
	{
		if(self::$instance === null)
			self::$instance = new static();
		return self::$instance;
	}
	/**
	 * converts an array of Models into an database friedly array
	 * @param array $collection
	 * @return array
	 */
	public abstract function toDbArray(array $collection);
	
	/**
	 * Converts an databasefriedly array into a Model Collection
	 * @param array $array
	 * @return array
	 */
	public abstract function toCollection(array $array);
}
