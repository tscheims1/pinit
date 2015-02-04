<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */

namespace ContentHandler;

/**
 * a ContentHandler für the MongoDb
 */
class MongoDbContentHandler
{
	/**
	 * mongoDB adapter
	 * @var \Core\Db\MongoDbAdapter\MongoDbAdapter
	 */
	protected $adapter;
	
	/**
	 * constructor
	 * @param array $config configuration array
	 */
	public function __construct(array $config)
	{
		
		$this->adapter = new MongoDbAdapter();
		$this->adpater->setUp($config);
	}
	/**
	 * get a specific model from the database
	 * @param array $query the database Query
	 * @return array the database record
	 */
	public function getContent($id)
	{
		return $this->adapter->findRecord(
			['table' => 'node',
			'condition' => ['_id' => $query]]);
	}
	
	/**
	 * write the content into database
	 * @param array $data: the record to save
	 * @return response value
	 */
	public function setContent($id,array $data)
	{
		return $this->adapter->updateRecord(
		['table' => 'node',
		'condition' => ['_id' => $id,],
		'data' => $data]);
	}
	
}
