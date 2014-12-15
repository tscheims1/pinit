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
 * Convert arrays to Model Collections
 * Convert Model Collections into arrays
 */
class ModelFactory extends BaseFactory
{
	/**
	 * converts an array of Models into an database friedly array
	 * @param array $collection
	 * @return array
	 */
	public function toDbArray(array $collection)
	{
		$array = [];
		foreach($collection as $ele)
		{
			if(is_subclass_of($ele, '\\Core\\Model\\BaseModel'))
			{
				$array[] = $ele->toArray();
			}
		}
		return $array;
	}
	/**
	 * Converts an databasefriedly array into a Model Collection
	 * @param array $array
	 * @return array
	 */
	public function toCollection(array $array)
	{
		$collection = [];
		
		foreach($array as $ele)
		{
			
			if(!isset($ele['type']))
				continue;
			
			$fullClassname = "\\".str_replace(".", "\\",$ele['type']);
			$collection[] = new $fullClassname($ele);
		}
		return $collection;
	}	
}

