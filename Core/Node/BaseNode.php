<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Node; 

/**
 * this class represents a single Node
 */ 
abstract class BaseNode
{
	/**
	 * an instance of the specific modelClass
	 * @var \Core\Model\BaseModel
	 */
	protected $model;
	
	/**
	 * convert the NodeContent in a JsonObject
	 * @return string
	 */
	abstract public function toJson();
	
	public function __construct(\Core\Model\BaseModel $model)
	{
		$this->model = $model;	
	}
}
?>