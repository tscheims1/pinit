<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Node;

use Core\Node\BaseNode;

/**
 * Just a simple TextNode Class
 */
class TextNode extends BaseNode
{
	public function toJson()
	{
		return json_encode($this->model->toArray());
	}
	
}
