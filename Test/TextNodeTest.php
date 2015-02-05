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

use \Model\TextModel;
use \Node\TextNode;

class TextNodeTest extends PHPUnit_Framework_TestCase
{
	public function testJsonModel()
	{
		$model = new TextModel();
		$node = new TextNode($model);
		
		$array = $model->toArray();
		$this->assertEquals(json_encode($array),$node->toJson());
	}
	
}
