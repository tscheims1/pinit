<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Model;

use Core\Tag\Tag;

/**
 * Abstract Model for a Document based Database
 */
abstract class BaseModel implements IModel
{
	/**
	 * unique id
	 * @var int
	 */
	protected $id;
	
	/**
	 * Model type
	 * @var string
	 */
	protected $type = null;
	
	/**
	 * All children relationships
	 * @var array
	 */
	protected $children = null;
	
	/**
	 * All Parent relationships
	 * @var array
	 */
	protected $parents = null;
	
	/**
	 * Handler for read Model's Content
	 * @var \Core\ContentHandler\BaseContentHandler
	 */
	protected $readContentHandler;
	
	/**
	 * Handler for write Model's Content
	 * @var \Core\ContentHandler\BaseContentHandler
	 */
	protected $writeContentHandler;
	
	/**
	 * Handler for write Model's Content
	 * @var \Core\ContentHandler\BaseContentHandler
	 */
	protected $deleteHandler;
	
	/**
	 * All Tags
	 * @var array
	 */
	protected $tags = [];
	
	/**
	 * @param array $data to set all Model properties OPTIONAL
	 */
	public function __construct(array $data = null)
	{
		if($data !== null)
			$this->toObject($data);
	}
	/**
	 * Convert the class Properties to an Array
	 * @return array
	 */
	public function toArray()
	{
		$tags = [];
		foreach($this->tags as $tag)
			$tags[] = $tag->toArray();
		return ['_id' 		=> $this->id,
				'children' 	=> $this->children,
				'parents' 	=> $this->parents,
				'tags' 		=> $tags,
				'type'		=> $this->type,
				];
	}
	
	/**
	 * @param array $data to set Model properties
	 */
	public function toObject(array $data)
	{
		if(isset($data['tags']))
			foreach($data['tags'] as $tag)
			{
				$this->tags[] = new Tag($tag);
			}
		$this->id 		= isset($data['_id'])?$data['_id']:null;
		$this->parents 	= isset($data['parents'])?$data['parents']:null;
		$this->children = isset($data['children'])?$data['children']:null;
	}
	/**
	 * @return array the content of the Model
	 */
	public function getContent()
	{
		return $this->readHanlder->getContent();
	}
	/**
	 * @param array $array update the node Content
	 * @return array response
	 */
	public function setContent(array $data)
	{
		return $this->writeHandler->setContent();
	}
}
?>