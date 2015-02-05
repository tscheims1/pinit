<?php
/**
 * __PROJEKTNAME__
 * 
 * @author James Mayr
 * @copyright __TEAMNAME__ 2014
 * @version 1.0
 */
namespace Core\Db;

/**
 * Just an abstract baseClass for dbAdapters
 */
abstract class BaseDbAdapter
{
	/**
	 * Database Setup 
	 * @param array $config the database Configuaration e.g: db name, pass,ect
	 */
	public abstract function setUp(array $config);
	
	/**
	 * store a Collection in the database
	 * @param array $collection
	 */
	public abstract function saveCollection(array $collection);
	
	/**
	 * find one or more model and return it as a collection
	 * @param array $query the databaseQuery
	 */
	public abstract function findCollection(array $query);
	
	/**
	 * update a specific Record
	 * @param array $dataQuery an array with  data and the database Query
	 * - table: TableName
	 * - condition: condition for update
	 * - data data to update
	 */
	public abstract function updateRecord(array $dataQuery);
	
	/**
	 * read a single record
	 * @param array $dataQuery an array with data and the databaseQuery
	 * -table: TableName
	 * -condition: condition for get first Record of the dataSet
	 */
	public abstract function findRecord(array $dataQuery);
	
	/**
	 * store a model in the database
	 * @param array $data the data-array of the model
	 * @return bool true if it was successful
	 */
	public abstract function insertModel(array $data);
	
	/**
	 * delete a model from the database
	 * @param the id of the model
	 * @return bool true if it was successful
	 */
	public abstract function deleteModel($id);
}
?>