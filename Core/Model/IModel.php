<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Model;
 
 
 /**
  * Interface for all document based Models
  */
interface IModel
{
	public function __construct(array $data = null);
	public function toArray();
	public function toObject(array $data);
	public function getId();
}
