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
require_once $path.'/Core/Db/BaseDbAdapter.php';
require_once $path.'/Core/Db/MongoDbAdapter/MongoDbAdapter.php';

use Core\Db\MongoDbAdapter\MongoDbAdapter;

class MongoDbAdapterTest extends PHPUnit_Framework_TestCase
{
	
	public function testIsSingletonAdapter()
	{
		
		$mongoInstance = \Core\Db\MongoDbAdapter\MongoDbAdapter::getInstance();
		$mongoInstance2 = \Core\Db\MongoDbAdapter\MongoDbAdapter::getInstance();
		
		$this->assertSame($mongoInstance,$mongoInstance2);
		$this->assertNotSame($mongoInstance,null);

	}
	public function testInsertAndFindInMongoDb()
	{
		$mongoInstance = MongoDbAdapter::getInstance();
		$mongoInstance->setUp(['db' => 'test']);
		
				
		$array =[
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'],
			[	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				
				'tags' => [['name' => 'häuser'],['name' => 'strasse']],
				'content' => 'some content']
			];
			
			/*
			 * tidy up the database
			 */
			$mongo = new \MongoClient();
			$db = $mongo->test;
			$db->node->remove();
			////////////////////////////////
			
			
			$mongoInstance->saveCollection($array);
			

			$collection = $mongoInstance->findCollection(array());
			
			foreach($collection as $key =>  $ele)
			{
				//Id is not comparable
				unset($collection[$key]['_id']);
			}
			
			$this->assertEquals($array,$collection);
			
			//tidy up the database
			$db->node->remove();
	}
	
}
