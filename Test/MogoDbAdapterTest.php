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

	public function testInsertAndFindInMongoDb()
	{
		
		$mongoInstance = new MongoDbAdapter();
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
			$db->test->remove();
	}
	public function testUpdateAndFindRecord()
	{
		/*
		 * tidy up the database
		 */
		$mongo = new \MongoClient();
		$db = $mongo->test;
		$db->node->remove();
		
		$array = [	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => new \MongoId(),
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'];
		$textModel = new \Model\TextModel($array);
		$db->node->insert($textModel->toArray());
		
		$cursor = $db->node->find(['tags' => ['name' => 'haus']]);
		$ele = [];
		foreach($cursor as $doc)
		{
			$ele[] = $doc;
		}
		
		$mongoDbAdapter = new MongoDbAdapter();
		$mongoDbAdapter->setUp(['db' => 'test']);
		$ele2 = $mongoDbAdapter->findRecord(['condition' => 
										['_id' => $ele[0]['_id']],
									 'table' => 'node',
									 ]);			
		$this->assertEquals($ele[0],$ele2);
		
		$ele2['content'] = 'updated...';
		
		$mongoDbAdapter->updateRecord(
									['condition' => ['_id' => $ele2['_id']],
									'table' => 'node',
									'data' => ['content' => $ele2['content']]]);
									
		$ele3 = $mongoDbAdapter->findRecord(['condition' => 
										['_id' => $ele[0]['_id']],
									 'table' => 'node',
									 ]);
		$this->assertEquals($ele3,$ele2);
		$this->assertNotEquals($ele3,null);
									
		
		
		
		
	}
	
}
