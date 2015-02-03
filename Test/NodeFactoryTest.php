<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
 
$path = dirname(__DIR__);

require_once $path.'/Core/Model/IModel.php';
require_once $path.'/Core/Model/BaseModel.php';
require_once $path.'/Model/TextModel.php';
require_once $path.'/Core/Factory/BaseFactory.php';
require_once $path.'/Core/Factory/ModelFactory.php';
require_once $path.'/Core/Factory/Exception/FactoryException.php';
require_once $path.'/Core/Node/BaseNode.php';
require_once $path.'/Node/TextNode.php';
require_once $path.'/Core/Factory/NodeFactory.php';



use Core\Factory\NodeFactory;
use Model\TextModel;
use Node\TextNode;

 /**
 * Test case for test the Node Factory 
 */
class NodeFactoryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Is the factory singleton?
	 */
	public function testIsSingleton()
	{
		$obj1 = NodeFactory::getInstance();
		$obj2 = NodeFactory::getInstance();
		
		$this->assertSame($obj1,$obj2);
		$this->assertNotSame(null,$obj1);
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
			
		$factory = NodeFactory::getInstance();
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
		$factory = NodeFactory::getInstance();
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
		$factory = NodeFactory::getInstance();
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
		$factory = NodeFactory::getInstance();
		$collection = $factory->toCollection($array);
		
		$collection[0] = new DateTime();
		
		$factory->toDbArray($collection);
		
	}
	public function testIsSameContent()
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
		
		$model1 = new TextModel($array[0]);
		$model2 = new TextModel($array[1]);
		$node1 = new TextNode($model1);
		$node2 = new TextNode($model2);
		
		$factory = NodeFactory::getInstance();
		$collection = $factory->toCollection($array);
		
		$this->assertEquals($collection[0],$node1);
		$this->assertEquals($collection[1],$node2);
		
	}


}
?>
