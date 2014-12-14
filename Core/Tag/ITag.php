<?php
/**
 * Pin-it
 * 
 * @author James Mayr
 * @copyright __TEAMNAME___ 2014
 * @version 1.0
 */
 
 
namespace Core\Tag;

interface ITag
{
	public function __construct(array $data = null);
	public function toArray();
	public function toObject(array $data);
	
}
