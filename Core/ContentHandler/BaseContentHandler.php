<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */

namespace Core\ContentHandler;

abstract class BaseContentHandler
{
	/**
	 * Method for get the contentHandler specific data
	 * @param array $id of the Model
	 * @return array get the contentHandler specific datasource
	 */
	abstract public function getContent($id);
	
	/**
	 * @param int $id id of the Model
	 * @param array $data the data for inserting into the ContentHandler 
	 * specific datasource
	 */
	abstract public function setContent($id,array $data);
}
?>