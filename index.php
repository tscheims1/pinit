<?php
/*
 * just for testing
 * 
 */
ini_set ( "display_errors", "1");
ini_set ( "display_startup_errors", "1");
ini_set ( "html_errors", "1");
error_reporting(-1);
require_once 'Core/Model/IModel.php';
require_once 'Core/Model/BaseModel.php';
require_once 'Model/TextModel.php';
require_once 'Core/Tag/ITag.php';
require_once 'Core/Tag/Tag.php';
require_once 'Core/Factory/BaseFactory.php';
require_once 'Core/Factory/ModelFactory.php';
require_once 'Core/Factory/Exception/FactoryException.php';

$factory = \Core\Factory\ModelFactory::getInstance();

$arr =[['children' => null,'parents' => null,'type' => 'Model.TextModel', '_id' => 32,'tags' => [['name' => 'haus']],'content' => 'text text text']];

$collection = $factory->toCollection($arr);
print_r($collection);

$arr2 = $factory->toDbArray($collection);
print_r($arr2);
print_r($arr);
if($arr2 == $arr)echo "geschaft";

/*
$textNode = new \Model\TextNode();

$mongoClient = new MongoClient();

$db = $mongoClient->selectDB('pinit');

$nodes = $db->node;
$textNode->toObject(['id' => 12, 'content' => 'text text text']);
print_r($textNode->toArray());

$nodes->insert($textNode->toArray());

$cursor = $nodes->find();
foreach($cursor as $document)
{
	print_r($document);
}*/


?>