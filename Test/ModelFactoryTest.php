<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
 
$path = dirname(__DIR__);

require_once $path.'/SetUp/functions.php';
/* 	
require_once $path.'/Core/Model/IModel.php';
require_once $path.'/Core/Model/BaseModel.php';
require_once $path.'/Model/TextModel.php';
require_once $path.'/Core/Factory/BaseFactory.php';
require_once $path.'/Core/Factory/ModelFactory.php';
require_once $path.'/Core/Factory/Exception/FactoryException.php';
require_once $path.'/Core/ContentHandler/Exception/ContentHandlerException.php';
require_once $path.'/Core/ContentHandler/BaseContentHandler.php';
require_once $path.'/ContentHandler/MongoDbContentHandler.php';*/

use Core\Factory\ModelFactory;

 /**
 * Test case for test the Model Factory 
 */
class ModelFactoryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Is the factory singleton?
	 */
	public function testIsSingleton()
	{
		$obj1 = ModelFactory::getInstance();
		$obj2 = ModelFactory::getInstance();
		
		$this->assertSame($obj1,$obj2);
	}
	
	
	/**
	 * Test to create a collection
	 */
	public function testCreateCollectionFromArray()
	{
		$array =[
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 32,
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'],
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 33,
				'tags' => [['name' => 'häuser'],['name' => 'strasse']],
				'content' => 'some content']
			];
			
		$factory = ModelFactory::getInstance();
		$collection = $factory->toCollection($array);
		$arrayFromCollection = $factory->toDbArray($collection);
		
		$this->assertEquals($array,$arrayFromCollection);
	}
	/**
     * @expectedException Core\Factory\Exception\FactoryException
     */
	public function testNoTypeException()
	{
		$array =[
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 32,
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'],
			[	
				'children' => null,
				'parents' => null,
				'typ' => 'Model.TextModel', 
				'_id' => 33,
				'tags' => [['name' => 'häuser'],['name' => 'strasse']],
				'content' => 'some content']
			];
		$factory = ModelFactory::getInstance();
		$collection = $factory->toCollection($array);
	}
	/**
     * @expectedException Core\Factory\Exception\FactoryException
     */
	public function testInvalidClassTypeException()
	{
		$array =[
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 32,
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'],
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.InvalidClass', 
				'_id' => 33,
				'tags' => [['name' => 'häuser'],['name' => 'strasse']],
				'content' => 'some content']
			];
		$factory = ModelFactory::getInstance();
		$collection = $factory->toCollection($array);
	}
	/**
	 * @expectedException Core\Factory\Exception\FactoryException
	 */
	public function testInvalidTypePropertyValueException()
	{
		$array =[
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 32,
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'],
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => 33,
				'tags' => [['name' => 'häuser'],['name' => 'strasse']],
				'content' => 'some content']
			];
		$factory = ModelFactory::getInstance();
		$collection = $factory->toCollection($array);
		
		$collection[0] = new DateTime();
		
		$factory->toDbArray($collection);
		
	}


}
?>
