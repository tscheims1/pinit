<?php
/*
 * just for testing
 * 
 */
ini_set ( "display_errors", "1");
ini_set ( "display_startup_errors", "1");
ini_set ( "html_errors", "1");
error_reporting(-1);
require_once 'Core/Node/INode.php';
require_once 'Core/Node/BaseNode.php';
require_once 'Model/TextNode.php';
require_once 'Core/Tag/ITag.php';
require_once 'Core/Tag/Tag.php';


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