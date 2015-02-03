<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */

namespace Core\Factory;


use Core\Factory\Exception\FactoryException;

/**
 * Convert arrays to Node Collections
 * Convert Node Collections into arrays
 */
class NodeFactory extends BaseFactory
{
	/**
	 * converts an array of Nodes into an database friedly array
	 * @param array $collection
	 * @return array
	 */
	public function toDbArray(array $collection)
	{
		$array = [];
		foreach($collection as $ele)
		{
			if(!is_subclass_of($ele, '\\Core\\Node\\BaseNode'))
				throw new FactoryException('Type isn\'t Subclass of \\Core\\Node\\BaseNode');
			
			$array[] = $ele->getModel()->toArray();
		}
		return $array;
	}
	/**
	 * Converts an databasefriedly array into a Node Collection
	 * @param array $array
	 * @return array
	 */
	public function toCollection(array $array)
	{
		$collection = [];
		
		foreach($array as $ele)
		{
			
			if(!isset($ele['type']))
				throw new FactoryException('Type of Object not defined');
			
			$fullClassname = "\\".str_replace(".", "\\",$ele['type']);
			
			if(!is_subclass_of($fullClassname, '\\Core\\Model\BaseModel'))
				throw new FactoryException('Type isn\'t Subclass of \\Core\\Model\\BaseModel');
			$model = new $fullClassname($ele);
			
			$fullNodeName = str_replace('Model', 'Node',$fullClassname);
			if(!is_subclass_of($fullNodeName, '\\Core\\Node\\BaseNode'))
				throw new FactoryException('Node isn\'t Subclass of \\Core\\Node\\BaseNode');
			
			$collection[] =  new $fullNodeName($model);
		}
		return $collection;
	}	
}

