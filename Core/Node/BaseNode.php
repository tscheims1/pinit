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
	 * a collection of connected nodes
	 * @var array
	 */
	protected $connectedNodes;
	
	/**
	 * parentNodes
	 * @var \Core\Node\BaseNode
	 */
	protected $parentNodes;
	
	/**
	 * children Nodes
	 * @var array
	 */
	protected $childNodes;
	
	/**
	 * convert the NodeContent in a JsonObject
	 * @return string
	 */
	abstract public function toJson();
	
	public function __construct(\Core\Model\BaseModel $model)
	{
		$this->model = $model;	
	}
	/**
	 * getter method for the model
	 * @return \Core\Model\BaseModel
	 */
	public function getModel()
	{
		return $this->model;
	}
	/**
	 * method to update the specific node
	 * @param array $data content to insert 
	 * @return array $response 
	 */
	 public function setContent(array $data)
	 {
	 	return $this->model->setContent($data);
	 }
	 
	 /**
	 * method to get the specific node data 
	 * @return array $data 
	 */
	 public function getContent()
	 {
	 	return $this->model->getContent();
	 }
}
?>