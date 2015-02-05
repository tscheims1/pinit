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

class MongoDbContentHandlerTest extends PHPUnit_Framework_TestCase
{

	public function testGetContent()
	{
		
		$mongoInstance = new \Core\Db\MongoDbAdapter\MongoDbAdapter();
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
			
			$mContentHandler = new \ContentHandler\MongoDbContentHandler(['db' => 'test']);
			
			$content = array();
			foreach($collection as $ele)
			{
				
				$contentArr = $mContentHandler->getContent($ele['_id']);
				
				$this->assertEquals($ele,$contentArr);	
			}
			//tidy up the database
			$db->node->remove();
	}

	public function testSetContent()
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
		
		$mContentHandler = new \ContentHandler\MongoDbContentHandler(['db' => 'test']);
		$mContentHandler->setContent($array['_id'],['content' => 'updated...']);
		$array['content'] = 'updated...';
		
		$content = $mContentHandler->getContent($array['_id']);
		
		$cur = $db->node->find(['_id' => $array['_id']]);
		$content2 = [];
		foreach($cur as $obj)
		{
			$content2[] = $obj;
		}
	
		$this->assertEquals($content2[0],$content);
		$this->assertEquals($content,$array);
		$this->assertNotEquals(null,$content2);
									
		
		
		
		
	}
	
}

