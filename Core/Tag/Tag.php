<?php
/**
 * Pin-it
 * 
 * @author James Mayr
 * @copyright __TEAMNAME___ 2014
 * @version 1.0
 */
 
 namespace Core\Tag;
 
 /**
  * This class represents a Tag
  */
 class Tag implements ITag
 {
 	/**
	 * Name of the Tag
	 * @var string
	 */
 	protected $name;
	/**
	 * 
	 * @param array $data  set the property data OPTIONAL
	 */
 	public function __construct(array $data = null)
	{
		if($data !==null)
			$this->toObject($data);	
	}
	/**
	 * @param array $data set the property data
	 */
	public function toObject(array $data)
	{
		$this->name = isset($data['name'])?$data['name']:null;
	}
	/**
	 * Convert properties to an array
	 * @return array
	 */
	public function toArray()
	{
		return ['name' => $this->name];
	}
 }

