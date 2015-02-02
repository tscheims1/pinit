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
