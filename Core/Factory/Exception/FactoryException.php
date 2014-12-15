<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Factory\Exception;

/**
 * Custom Exception for the Facory class
 */
class FactoryException extends \Exception
{
	public function __construct($message, $code = 0, Exception $previous = null) 
	{
		parent::__construct($message,$code,$previous);
	}
}
?>