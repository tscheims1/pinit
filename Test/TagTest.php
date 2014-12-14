<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME___ 2014
 * @version 1.0
 */
 
$path = dirname(__DIR__);

require_once $path.'/Core/Tag/ITag.php';
require_once $path.'/Core/Tag/Tag.php';
 

/**
 * Test Cases for the Tag Model
 */
class TagTest extends PHPUnit_Framework_TestCase
{
	public function testCreateTag()
	{
		$tag = new \Core\Tag\Tag();
		$this->assertEquals(['name' => null],$tag->toArray());
		
		$pet = ['name' => 'pet'];
		$tag->toObject($pet);
		$this->assertEquals($pet,$tag->toArray());
	}
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testInvalidParameters()
	{
		$tag = new \Core\Tag\Tag("string");
	}
	public function testInvalidFieldObject()
	{
		$tag = new \Core\Tag\Tag(['names' => 'wrong']);
		$this->assertEquals(['name' => null],$tag->toArray());
		
		$tag = new \Core\Tag\Tag();
		$tag->toObject(['names' => 'wrong']);
		$this->assertEquals(['name' => null],$tag->toArray());
	}
 }
 ?>