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

use Model\TextModel;


/**
 * Test Cases for the TextModel
 */
class TextModelTest extends PHPUnit_Framework_TestCase
{
	public function testCreateModel()
	{
		$textModel = new TextModel();
		
		$array = [	'_id' => null,
					'parents' => null,
					'children' => null,
					'content' => null,
					'tags'	  => [],
					'type'	  => 'Model.TextModel',
					];
		
		$this->assertEquals($array,$textModel->toArray());
		
		
		
		$array = [
			'content' => 'Text Text Text',
			'_id' 		=> 123456789,
			'parents' 	=> [1,2,3,],
			'children' 	=> [2,3,4,],
			'tags'		=> [['name' => 'abc'],['name' => 'abc']],	
		];
		
		$textModel = new TextModel($array);
		$array2 =  $array;
		
		$array2['type'] = 'Model.TextModel';
		$this->assertEquals($array2,$textModel->toArray());
		
		
		
		$textModel = new TextModel();
		$textModel->toObject($array);
		
		$this->assertEquals($array2,$textModel->toArray());
	}
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testInvalidParameters()
	{
		$textModel = new TextModel("string");
	}
		/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testInvalidParametersToobject()
	{
		$textModel = new TextModel();
		$textModel->toObject("string");
	}
	public function testInvalidFieldObject()
	{
		$testArray = [	
						'_id' => null,
						'parents' => null,
						'children' => null,
						'content' => null,
						'tags'	  => [],
					];
		
		$textModel = new TextModel(['names' => 'wrong']);
		
		$testArray2 = $testArray;
		$testArray2['type'] = 'Model.TextModel';
		$this->assertEquals($testArray2,$textModel->toArray());
		
		$textModel = new TextModel();
		$textModel->toObject(['names' => 'wrong']);
		$this->assertEquals($testArray2,$textModel->toArray());
	}
}
?>
 