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
			$db->node->remove();
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
	public function testInsertModelMethod()
	{
		/*
		 * tidy up the database
		 */
		$mongo = new \MongoClient();
		$db = $mongo->test;
		$db->node->remove();
		
		
		$mongoDbAdapter = new MongoDbAdapter();
		$mongoDbAdapter->setUp(['db' => 'test']);
		
		$array = [	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => new \MongoId(),
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'];
		$textModel = new \Model\TextModel($array);
		
		$mongoDbAdapter->insertModel($textModel->toArray());
		
		$cursor = $db->node->find(['_id' => $array['_id']]);
		$dbArr =[];
		foreach($cursor as $ele)
		{
			$dbArr[] = $ele;	
		}
		$textModel2 = new \Model\TextModel($dbArr[0]);
		$this->assertEquals($textModel2,$textModel);
		
	}
	public function testDeleteModel()
	{
		/*
		 * tidy up the database
		 */
		$mongo = new \MongoClient();
		$db = $mongo->test;
		$db->node->remove();
		
		$mongoDbAdapter = new MongoDbAdapter();
		$mongoDbAdapter->setUp(['db' => 'test']);
		
		$array = [	
				'children' => null,
				'parents' => null,
				'type' => 'Model.TextModel', 
				'_id' => new \MongoId(),
				'tags' => [['name' => 'haus'],['name' => 'balkon']],
				'content' => 'text text text'];
		$textModel = new \Model\TextModel($array);
		
		$mongoDbAdapter->insertModel($textModel->toArray());
		
		$mongoDbAdapter->deleteModel($array['_id']);
		
		$cursor = $db->node->find(['_id' => $array['_id']]);	
		$dbArr = [];
		foreach($cursor as $ele)
		{
			$dbArr[] = $ele;
		
		}
		
		$this->assertSame($dbArr,[]);
	
	}
	
}
