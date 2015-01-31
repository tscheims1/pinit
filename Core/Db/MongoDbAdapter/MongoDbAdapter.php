<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Db\MongoDbAdapter;

/**
 * An adapter for the document based db mogoDb
 * 
 */ 
class MongoDbAdapter extends \Core\Db\BaseDbAdapter
{
	/**
	 * An Instance of the MongoDbClient 
	 *
	 * @var MogoDbClient
	 */
	protected $mongoDbClient; 
	
	/**
	 * the mogoDb Object
	 * @var object
	 */
	protected $db;
	
	/**
	 * SetUp the database connection
	 * @param array $config configuration array
	 */
	public function setUp(array $config)
	{
		$this->mongoDbClient = new \MongoClient();
		
		$db = isset($config['db'])?$config['db']:null;
		$this->db = $this->mongoDbClient->selectDb($db);
	}
	
	/**
	 * method for save collections
	 * @param array the CollectionArray
	 */
	public function saveCollection(array $collection)
	{
		$nodes = $this->db->node;
		
		foreach($collection as $ele)
		{
			$ele['_id'] = new \MongoId();
			$nodes->insert($ele);
		}
		
	}
	
	/**
	 * method for find specific models
	 * @param array $query the dbQuery
	 */
	public function findCollection(array $query)
	{
		$nodes = $this->db->node;
		$cursor = $nodes->find($query);
		$documentArray = array();
		foreach($cursor as $document)
		{
				$documentArray[] = $document;
		}
		return $documentArray;
	}
	
}
?>
