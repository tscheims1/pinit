<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\ContentHandler\Exception;

/**
 * Custom Exception for the ContentHalder classes
 */
class ContentHandlerException extends \Exception
{
	public function __construct($message, $code = 0, Exception $previous = null) 
	{
		parent::__construct($message,$code,$previous);
	}
}
?>