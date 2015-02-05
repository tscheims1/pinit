<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
 

/**
 * custom autoloader
 */ 
function myAutoload($className)
{
	
	$basePath = dirname(__DIR__);
	$fileName = $basePath.'/'.str_replace('\\', '/', $className).'.php';
	//Necessary for using is_subclass_of or is_instance_of methods
	if(file_exists($fileName))
		require $fileName;
}
spl_autoload_register('myAutoload');
