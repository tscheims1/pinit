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
	/**
	 * read a single record
	 * @param array $dataQuery an array with data and the databaseQuery
	 * -table: TableName
	 * -condition: condition for get first Record of the dataSet
	 * @return mixed return array of the Record or null
	 */
	public function findRecord(array $dataQuery)
	{
		$table = isset($dataQuery['table'])?$dataQuery['table']:null;
		$condition = isset($dataQuery['condition'])?$dataQuery['condition']:null;
		
		$dbTable = $this->db->{$table};
		
		$cursor = $dbTable->find($condition);
		if($cursor->count() > 0)
		{
			$cursor->next();
			return $cursor->current();
		}
		return null;
	}
	/**
	 * update a specific Record
	 * @param array $dataQuery an array with  data and the database Query
	 * - table: TableName
	 * - condition: condition for update
	 * - data data to update
	 */
	public function updateRecord(array $dataQuery)
	{
		$table = isset($dataQuery['table'])?$dataQuery['table']:null;
		$condition = isset($dataQuery['condition'])?$dataQuery['condition']:null;
		$data = isset($dataQuery['data'])?$dataQuery['data']:null;
		
		$dbTable = $this->db->{$table};
		return $dbTable->update($condition,['$set' => $data]);
	}
	
	
}
?>
