<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Model;
 
use Core\Model\BaseModel; 
/**
 * Just a simple Text node
 */ 
class TextModel extends BaseModel
{
	/**
	 * Property for text content
	 * @var string
	 */
	protected $content;
	
	protected $type = 'Model.TextModel';
	
	/**
	 * @param $data array set properties
	 */
	public function toObject(array $data)
	{
		parent::toObject($data);
		$this->content = isset($data['content'])?$data['content']:null;	
	}
	/**
	 * Convert properties to an array
	 * @return array
	 */
	public function toArray()
	{
		$data = parent::toArray();
		$data['content'] = $this->content;
		return $data;
	}
}
?>