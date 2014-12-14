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
}
?>